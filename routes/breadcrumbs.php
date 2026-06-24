<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Admin\Postingan;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


// ============ Dashboard Admin ============
// Home
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('dashboard_home', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Home', route('dashboard'));
});

// Home > Dokter
Breadcrumbs::for('dashboard_dokter', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Dokter', route('dokter'));
});

// home > doker > jadwal
Breadcrumbs::for('dashboard_dokter_jadwal', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard_dokter');
    $trail->push('Jadwal', route('dokter.jadwal'));
});

// home > doker > create
Breadcrumbs::for('dashboard_dokter_create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard_dokter');
    $trail->push('Tambah', route('dokter.create'));
});

// home > doker > edit
Breadcrumbs::for('dashboard_dokter_edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard_dokter');
    $trail->push('Edit', route('dokter.edit', ['id' => 1]));
});

// home > user
Breadcrumbs::for('dashboard_user', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User', route('user'));
});

// home > user > create
Breadcrumbs::for('dashboard_user_create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard_user');
    $trail->push('Tambah', route('user.create'));
});

// home > postingan
Breadcrumbs::for('dashboard_postingan', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Postingan', route('postingan'));
});

// home > karir
Breadcrumbs::for('dashboard_karir', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Karir', route('karir.admin'));
});

// home > postingan > create
Breadcrumbs::for('dashboard_postingan_create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard_postingan');
    $trail->push('Tambah', route('postingan.create'));
});

// home > karir > create
Breadcrumbs::for('dashboard_karir_create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard_karir');
    $trail->push('Tambah', route('karir.admin.create'));
});

// home > karir > edit
Breadcrumbs::for('dashboard_karir_edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard_karir');
    $trail->push('Edit', route('karir.admin.edit', ['id' => 1]));
});

// home > promo
Breadcrumbs::for('dashboard_promo', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Promo', route('listPromo'));
});

// home > promo > create
Breadcrumbs::for('dashboard_promo_create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard_promo');
    $trail->push('Tambah', route('listPromo.create'));
});

// home > promo
Breadcrumbs::for('dashboard_layanan', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Layanan', route('layanan'));
});

// home > promo > create
Breadcrumbs::for('dashboard_layanan_create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard_layanan');
    $trail->push('Tambah', route('layananStore'));
});

// home > layanan medis
Breadcrumbs::for('dashboard_layanan_medis', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Layanan Medis', route('listLayananMedis'));
});

// home > layanan medis > create
Breadcrumbs::for('dashboard_layanan_medis_create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard_layanan_medis');
    $trail->push('Tambah', route('listLayananMedis.create'));
});

// home > partner asuransi
Breadcrumbs::for('dashboard_partner_asuransi', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Partner Asuransi', route('partnerAsuransi'));
});

// home > partner asuransi > create
Breadcrumbs::for('dashboard_partner_asuransi_create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard_partner_asuransi');
    $trail->push('Tambah', route('partner-asuransi.create'));
});

// home > partner asuransi > edit
Breadcrumbs::for('dashboard_partner_asuransi_edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard_partner_asuransi');
    $trail->push('Edit', route('partner-asuransi.edit', ['id' => 1]));
});