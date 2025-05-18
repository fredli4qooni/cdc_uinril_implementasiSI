<?php

// app/Helpers/StatusHelper.php

if (!function_exists('getStatusBadgeClass')) {
    /**
     * Mendapatkan kelas CSS Bootstrap Badge berdasarkan status aplikasi.
     *
     * @param string|null $status Status aplikasi (pending, reviewed, accepted, rejected, cancelled)
     * @return string Kelas CSS badge
     */
    function getStatusBadgeClass(?string $status): string
    {
        switch (strtolower($status ?? '')) {
            case 'pending':
                return 'bg-secondary';
            case 'reviewed':
                return 'bg-info';
            case 'accepted':
                return 'bg-success';
            case 'rejected':
                return 'bg-danger';
            case 'cancelled':
                return 'bg-dark';
            default:
                return 'bg-light text-dark'; 
        }
    }
}

if (!function_exists('getVacancyStatusBadgeClass')) {
     /**
     * Mendapatkan kelas CSS Bootstrap Badge berdasarkan status lowongan.
     *
     * @param string|null $status Status lowongan (open, closed)
     * @return string Kelas CSS badge
     */
    function getVacancyStatusBadgeClass(?string $status): string
    {
        switch (strtolower($status ?? '')) {
            case 'open':
                return 'bg-success';
            case 'closed':
                return 'bg-secondary';
            default:
                return 'bg-light text-dark';
        }
    }
}

