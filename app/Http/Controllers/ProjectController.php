<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use App\Models\Upload;
use App\Models\UploadFile;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Student;
use App\Models\Propose;
use App\Models\Advisor;
use App\Models\ProjectType;
use App\Models\AlumniProject;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Pagination\LengthAwarePaginator;


class ProjectController extends Controller
{
    // public function index(Request $request)
    // {
    //     $typeId = $request->integer('type');
    //     $by     = $request->input('by', 'all'); // all|title|keyword|abstract
    //     $q      = trim((string) $request->input('q', ''));

    //     /* =========================================================
    //  | 1) Upload (โครงงานสอบ)
    //  ========================================================= */
    //     $uploadBase = Upload::query()
    //         ->with(['revision.exam_submission.propose', 'file'])
    //         ->where('status', 0)
    //         ->when($typeId, function ($qB) use ($typeId) {
    //             $qB->whereHas(
    //                 'revision.exam_submission.propose',
    //                 fn($qq) => $qq->where('type_id', $typeId)
    //             );
    //         });

    //     if ($q !== '' && $by === 'abstract') {
    //         // 🔎 abstract search (เหมือนเดิมของคุณ)
    //         $bin = env('PDFTOTEXT_PATH', 'pdftotext');
    //         $matchedIds = [];

    //         (clone $uploadBase)
    //             ->whereHas('file', fn($qq) => $qq->whereNotNull('abstract_file'))
    //             ->orderBy('id')
    //             ->chunkById(200, function ($chunk) use (&$matchedIds, $q, $bin) {
    //                 foreach ($chunk as $row) {
    //                     $raw  = optional($row->file)->abstract_file;
    //                     $path = $this->realAbstractPath($raw);
    //                     if (!$path) continue;

    //                     $text = $this->extractPdfText($path, $bin);
    //                     if ($text && $this->containsUtf8($text, $q)) {
    //                         $matchedIds[] = $row->id;
    //                     }
    //                 }
    //             });

    //         $uploads = (clone $uploadBase)
    //             ->whereIn('id', $matchedIds ?: [0])
    //             ->get();
    //     } else {
    //         $uploads = (clone $uploadBase)
    //             ->when($q !== '', function ($qB) use ($q, $by) {
    //                 switch ($by) {
    //                     case 'title':
    //                         $qB->whereHas(
    //                             'revision.exam_submission.propose',
    //                             fn($qq) => $qq->where('title', 'like', "%{$q}%")
    //                         );
    //                         break;
    //                     case 'keyword':
    //                         $qB->where('keyword', 'like', "%{$q}%");
    //                         break;
    //                     default:
    //                         $qB->where(function ($or) use ($q) {
    //                             $or->where('keyword', 'like', "%{$q}%")
    //                                 ->orWhereHas(
    //                                     'revision.exam_submission.propose',
    //                                     fn($qq) => $qq->where('title', 'like', "%{$q}%")
    //                                 );
    //                         });
    //                 }
    //             })
    //             ->get();
    //     }

    //     /* =========================================================
    //  | 2) Alumni Project (โครงงานศิษย์เก่า)
    //  ========================================================= */
    //     $alumniProjects = AlumniProject::query()
    //         ->with('files')
    //         ->when($typeId, fn($q) => $q->where('project_type_id', $typeId))
    //         ->when($q !== '' && $by !== 'abstract', function ($qB) use ($q, $by) {
    //             if ($by === 'title') {
    //                 $qB->where('title', 'like', "%{$q}%");
    //             } else {
    //                 $qB->where(function ($or) use ($q) {
    //                     $or->where('title', 'like', "%{$q}%")
    //                         ->orWhere('keyword', 'like', "%{$q}%");
    //                 });
    //             }
    //         })
    //         ->get();

    //     /* =========================================================
    //  | 3) Normalize → รวมเป็น collection เดียว
    //  ========================================================= */
    //     $projects = collect()

    //         // upload
    //         ->merge(
    //             $uploads->map(fn($u) => [
    //                 'id'        => $u->id,
    //                 'title'     => data_get($u, 'revision.exam_submission.propose.title'),
    //                 'keyword'   => $u->keyword,
    //                 'cover_url' => $u->cover_url,
    //                 'source'    => 'upload',
    //             ])
    //         )

    //         // alumni
    //         ->merge(
    //             $alumniProjects->map(fn($a) => [
    //                 'id'        => $a->id,
    //                 'title'     => $a->title,
    //                 'keyword'   => $a->keyword,
    //                 'cover_url' => $a->files->first()?->cover_file
    //                     ? asset('storage/' . ltrim($a->files->first()->cover_file, '/'))
    //                     : null,
    //                 'source'    => 'alumni',
    //             ])
    //         )

    //         ->sortByDesc('id')
    //         ->values();

    //     /* ========================================================= */

    //     // =========================================================
    //     // 4) Manual Pagination (สำหรับ collection ที่ merge เอง)
    //     // =========================================================
    //     $perPage = 20;
    //     $page    = request()->integer('page', 1);
    //     $total   = $projects->count();

    //     $projects = new LengthAwarePaginator(
    //         $projects->slice(($page - 1) * $perPage, $perPage)->values(),
    //         $total,
    //         $perPage,
    //         $page,
    //         [
    //             'path'  => request()->url(),
    //             'query' => request()->query(), // สำคัญมาก (เก็บ ?type & ?q)
    //         ]
    //     );
    //     // =========================================================

    //     $types = ProjectType::orderBy('name')->get();

    //     return view('project.index', compact(
    //         'projects',
    //         'types',
    //         'typeId'
    //     ));
    // }

    public function index(Request $request)
    {
        $typeId = $request->integer('type');
        $by     = $request->input('by', 'all'); // all|title|keyword|abstract
        $q      = trim((string) $request->input('q', ''));

        // ดึง Path ของ pdftotext มาไว้ด้านบนสุด เพื่อให้ใช้ร่วมกันได้ทั้ง 2 โมเดล
        $bin    = env('PDFTOTEXT_PATH', 'pdftotext');

        /* =========================================================
         | 1) Upload (โครงงานสอบ)
         ========================================================= */
        $uploadBase = Upload::query()
            ->with(['revision.exam_submission.propose', 'file'])
            ->where('status', 0)
            ->when($typeId, function ($qB) use ($typeId) {
                $qB->whereHas(
                    'revision.exam_submission.propose',
                    fn($qq) => $qq->where('type_id', $typeId)
                );
            });

        if ($q !== '' && $by === 'abstract') {
            $matchedIds = [];

            (clone $uploadBase)
                ->whereHas('file', fn($qq) => $qq->whereNotNull('abstract_file'))
                ->orderBy('id')
                ->chunkById(200, function ($chunk) use (&$matchedIds, $q, $bin) {
                    foreach ($chunk as $row) {
                        $raw  = optional($row->file)->abstract_file;
                        $path = $this->realAbstractPath($raw);
                        if (!$path) continue;

                        $text = $this->extractPdfText($path, $bin);
                        if ($text && $this->containsUtf8($text, $q)) {
                            $matchedIds[] = $row->id;
                        }
                    }
                });

            $uploads = (clone $uploadBase)
                ->whereIn('id', $matchedIds ?: [0])
                ->get();
        } else {
            $uploads = (clone $uploadBase)
                ->when($q !== '', function ($qB) use ($q, $by) {
                    switch ($by) {
                        case 'title':
                            $qB->whereHas(
                                'revision.exam_submission.propose',
                                fn($qq) => $qq->where('title', 'like', "%{$q}%")
                            );
                            break;
                        case 'keyword':
                            $qB->where('keyword', 'like', "%{$q}%");
                            break;
                        default:
                            $qB->where(function ($or) use ($q) {
                                $or->where('keyword', 'like', "%{$q}%")
                                    ->orWhereHas(
                                        'revision.exam_submission.propose',
                                        fn($qq) => $qq->where('title', 'like', "%{$q}%")
                                    );
                            });
                    }
                })
                ->get();
        }

        /* =========================================================
         | 2) Alumni Project (โครงงานศิษย์เก่า)
         ========================================================= */
        $alumniBase = AlumniProject::query()
            ->with('files')
            ->when($typeId, fn($q) => $q->where('project_type_id', $typeId));

        if ($q !== '' && $by === 'abstract') {
            // 🔎 abstract search สำหรับ AlumniProject
            $alumniMatchedIds = [];

            (clone $alumniBase)
                ->whereHas('files', fn($qq) => $qq->whereNotNull('abstract_file'))
                ->orderBy('id')
                ->chunkById(200, function ($chunk) use (&$alumniMatchedIds, $q, $bin) {
                    foreach ($chunk as $row) {
                        // AlumniProject เก็บไฟล์ใน relation 'files' (hasMany) ดึงตัวแรกมาเช็ค
                        $raw  = optional($row->files->first())->abstract_file;
                        $path = $this->realAbstractPath($raw);
                        if (!$path) continue;

                        $text = $this->extractPdfText($path, $bin);
                        if ($text && $this->containsUtf8($text, $q)) {
                            $alumniMatchedIds[] = $row->id;
                        }
                    }
                });

            $alumniProjects = (clone $alumniBase)
                ->whereIn('id', $alumniMatchedIds ?: [0])
                ->get();
        } else {
            // ค้นหาปกติ (title, keyword, all)
            $alumniProjects = (clone $alumniBase)
                ->when($q !== '', function ($qB) use ($q, $by) {
                    if ($by === 'title') {
                        $qB->where('title', 'like', "%{$q}%");
                    } elseif ($by === 'keyword') {
                        $qB->where('keyword', 'like', "%{$q}%");
                    } else {
                        $qB->where(function ($or) use ($q) {
                            $or->where('title', 'like', "%{$q}%")
                                ->orWhere('keyword', 'like', "%{$q}%");
                        });
                    }
                })
                ->get();
        }

        /* =========================================================
         | 3) Normalize → รวมเป็น collection เดียว
         ========================================================= */
        $projects = collect()
            ->merge(
                $uploads->map(fn($u) => [
                    'id'        => $u->id,
                    'title'     => data_get($u, 'revision.exam_submission.propose.title'),
                    'keyword'   => $u->keyword,
                    'cover_url' => $u->cover_url,
                    'source'    => 'upload',
                ])
            )
            ->merge(
                $alumniProjects->map(fn($a) => [
                    'id'        => $a->id,
                    'title'     => $a->title,
                    'keyword'   => $a->keyword,
                    'cover_url' => $a->files->first()?->cover_file
                        ? asset('storage/' . ltrim($a->files->first()->cover_file, '/'))
                        : null,
                    'source'    => 'alumni',
                ])
            )
            ->sortByDesc('id')
            ->values();

        /* =========================================================
         | 4) Manual Pagination (สำหรับ collection ที่ merge เอง)
         ========================================================= */
        $perPage = 20;
        $page    = request()->integer('page', 1);
        $total   = $projects->count();

        $projects = new LengthAwarePaginator(
            $projects->slice(($page - 1) * $perPage, $perPage)->values(),
            $total,
            $perPage,
            $page,
            [
                'path'  => request()->url(),
                'query' => request()->query(),
            ]
        );

        $types = ProjectType::orderBy('name')->get();

        return view('project.index', compact(
            'projects',
            'types',
            'typeId'
        ));
    }

    /**
     * ดึง path จริงของไฟล์ abstract (เหมือนเดิม)
     */
    private function realAbstractPath(?string $raw): ?string
    {
        if (!$raw) return null;
        $rel = str_replace('\\', '/', ltrim($raw, '/'));
        if (Str::startsWith($rel, 'storage/')) $rel = substr($rel, 8);
        if (Str::startsWith($rel, 'public/'))  $rel = substr($rel, 7);

        $cands = [
            Storage::disk('public')->path($rel),
            public_path('storage/' . $rel),
            storage_path('app/public/' . $rel),
        ];
        foreach ($cands as $p) if (is_file($p)) return $p;
        return null;
    }

    /**
     * เรียก pdftotext แล้วคืนข้อความ UTF-8 (หรือ null ถ้าผิดพลาด)
     */
    private function extractPdfText(string $path, string $bin): ?string
    {
        // -enc UTF-8    : เอาเป็น UTF-8
        // -layout       : คงลำดับ/ช่องว่างให้อ่านง่ายขึ้น
        // -eol unix     : บรรทัดจบแบบ \n (กัน \r\n)
        // -nopgbrk -q   : ลด page break/quiet
        $proc = new Process([$bin, '-enc', 'UTF-8', '-layout', '-eol', 'unix', '-nopgbrk', '-q', $path, '-']);
        $proc->setTimeout(15);
        $proc->run();

        if (!$proc->isSuccessful()) {
            return null;
        }
        return $proc->getOutput() ?? '';
    }

    /**
     * ค้นหาแบบทนทาน (normalize + ลบช่องว่างเกิน + เคสอินเซนซิทีฟแบบ multibyte)
     */
    private function containsUtf8(string $haystack, string $needle): bool
    {
        // ตรง ๆ ก่อน (เร็ว)
        if (stripos($haystack, $needle) !== false) {
            return true;
        }

        $h = $this->normalizeUtf8($haystack);
        $n = $this->normalizeUtf8($needle);
        if ($n === '') return false;

        return mb_stripos($h, $n, 0, 'UTF-8') !== false;
    }

    private function normalizeUtf8(string $s): string
    {
        // ถ้ามี ext-intl จะช่วย normalize รูปแบบสระ/วรรณยุกต์ให้เป็นมาตรฐานเดียวกัน
        if (class_exists('\Normalizer')) {
            $s = \Normalizer::normalize($s, \Normalizer::FORM_C) ?? $s;
        }
        $s = mb_strtolower($s, 'UTF-8');
        // รวมช่องว่างหลายตัวเป็นเว้นวรรคเดียว + ตัดหัวท้าย
        $s = preg_replace('/\s+/u', ' ', $s);
        return trim($s);
    }

    public function show(Request $request, string $source, int $id)
    {
        $typeId = $request->integer('type');
        $types  = ProjectType::orderBy('name')->get();

        /* =========================================
     | กรณี 1: upload (โครงงานสอบ)
     ========================================= */
        if ($source === 'upload') {

            $upload = Upload::with([
                'file',
                'revision.exam_submission.propose.project_type',
                'revision.exam_submission.propose.advisor',
                'revision.exam_submission.propose.project_group.group_members.student',
            ])->where('status', 0)->findOrFail($id);

            $propose = optional(optional($upload->revision)->exam_submission)->propose;

            $coverPath    = data_get($upload, 'file.cover_file');
            $abstractPath = data_get($upload, 'file.abstract_file');

            return view('project.show', [
                'source'       => 'upload',
                'project'      => $upload,
                'propose'      => $propose,
                'coverUrl'     => $coverPath ? asset('storage/' . ltrim($coverPath, '/')) : null,
                'abstractUrl'  => $abstractPath ? asset('storage/' . ltrim($abstractPath, '/')) : null,
                'types'        => $types,
                'typeId'       => $typeId,
            ]);
        }

        /* =========================================
     | กรณี 2: alumni_project (ศิษย์เก่า)
     ========================================= */
        if ($source === 'alumni') {

            $alumni = AlumniProject::with([
                'files', //
                'projectType',
                'advisor',
                'projectGroup.group_members.student',
            ])->findOrFail($id);

            return view('project.show', [
                'source'      => 'alumni',
                'project'     => $alumni,
                'propose'     => null,
                // 'coverUrl'    => $coverPath
                //     ? asset('storage/' . ltrim($coverPath, '/'))
                //     : null,
                'coverUrl' => $alumni->files->first()?->cover_file
                    ? asset('storage/' . ltrim($alumni->files->first()->cover_file, '/'))
                    : null,
                'abstractUrl' => $alumni->files->first()?->abstract_file
                    ? asset('storage/' . ltrim($alumni->files->first()->abstract_file, '/'))
                    : null,
                'types'       => $types,
                'typeId'      => $typeId,
            ]);
        }

        abort(404);
    }

    public function preview(string $source, int $id, string $type)
    {
        abort_unless(in_array($type, ['abstract', 'project', 'cover'], true), 404);

        if ($source === 'upload') {

            $upload = Upload::with('file')->where('status', 0)->findOrFail($id);
            $file = $upload->file;
        } elseif ($source === 'alumni') {

            $alumni = AlumniProject::with('files')->findOrFail($id);
            $file = $alumni->files->first();
        } else {
            abort(404);
        }

        abort_unless($file, 404);

        $attr = [
            'abstract' => 'abstract_file',
            'project'  => 'project_file',
            'cover'    => 'cover_file',
        ][$type];

        $raw  = $file->{$attr} ?? null;
        $path = $raw ? ltrim($raw, '/') : null;

        abort_if(!$path || !Storage::disk('public')->exists($path), 404);

        return response()->file(
            Storage::disk('public')->path($path),
            [
                'Content-Type'    => \File::mimeType(Storage::disk('public')->path($path)),
                'X-Frame-Options' => 'SAMEORIGIN',
            ]
        );
    }
}
