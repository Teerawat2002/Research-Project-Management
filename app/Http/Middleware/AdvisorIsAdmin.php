<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class AdvisorIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     $user = auth('advisors')->user(); // ใช้ guard advisors

    //     // ยังไม่ล็อกอิน หรือ ไม่ใช่ admin -> ห้ามเข้า
    //     if (!$user || $user->a_type !== 'admin') {
    //         abort(403, 'Forbidden'); // หรือ return redirect()->route('login');
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next, ...$roles)
    {
        $guard = Auth::guard('advisors');

        // เลือก route ชื่อ login ให้ถูก (ถ้าไม่มี advisors.login จะ fallback เป็น login)
        $loginRouteName = 'login';

        // ยังไม่ล็อกอิน → ไปหน้า login + เก็บ intended ไว้
        if (!$guard->check()) {
            $request->session()->put('url.intended', $request->fullUrl());
            
            return redirect()->route($loginRouteName)->with('swal', [
                'icon'  => 'warning',
                'title' => 'ต้องเข้าสู่ระบบ',
                'text'  => 'โปรดเข้าสู่ระบบด้วยสิทธิ์ผู้ดูแล (admin) เพื่อเข้าถึงหน้านี้',
            ]);
        }

        // ถ้าไม่ส่งพารามิเตอร์ => ค่าเริ่มต้นคือ admin-only
        $allowed = $roles ?: ['admin'];

        // เทียบแบบไม่สนตัวพิมพ์
        $userRole = strtolower((string) ($guard->user()->a_type ?? ''));
        $allowed  = array_map('strtolower', $allowed);

        if (!in_array($userRole, $allowed, true)) {
            // logout
            $guard->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route($loginRouteName)->with('swal', [
                'icon'  => 'error',
                'title' => 'สิทธิ์ไม่เพียงพอ',
                'text'  => 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้',
            ]);
        }

        return $next($request);
    }
}
