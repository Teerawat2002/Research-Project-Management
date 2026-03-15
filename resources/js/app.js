import './bootstrap';

// ===== jQuery =====
import $ from 'jquery';
window.$ = window.jQuery = $;

// ===== Select2 (ESM-safe) =====
import select2 from 'select2';
import 'select2/dist/css/select2.css';
select2($);

// ===== Alpine =====
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// ===== flatpickr =====
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";

document.addEventListener("DOMContentLoaded", function () {

    // flatpickr
    const startEl = document.querySelector("#datepicker-range-start");
    const endEl = document.querySelector("#datepicker-range-end");

    if (startEl && endEl) {
        const startPicker = flatpickr(startEl, {
            dateFormat: "Y-m-d",
            onChange: (_, dateStr) => endPicker.set("minDate", dateStr),
        });

        const endPicker = flatpickr(endEl, {
            dateFormat: "Y-m-d",
            onChange: (_, dateStr) => startPicker.set("maxDate", dateStr),
        });
    }

    // Select2
    if (!$.fn.select2) {
        console.error('Select2 not loaded');
        return;
    }

    // select2 ธรรมดา (ไม่ search)
    $('.select2').select2({
        width: '100%',
        placeholder: function () {
            return $(this).data('placeholder');
        },
        // allowClear: true,
        minimumResultsForSearch: Infinity
    });

    // select2 ที่ต้องค้นหา
    $('.select2-search').select2({
        width: '100%',
        placeholder: function () {
            return $(this).data('placeholder');
        },
        // allowClear: true
    });

    // select2 แบบเลือกหลายค่า
    $('.select2-multi').select2({
        width: '100%',
        placeholder: function () {
            return $(this).data('placeholder');
        },
        // allowClear: true
    });
});
