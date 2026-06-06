@extends('frontend::layouts.user')
@section('title',__('Deposit'))

@push('style')
<style>/* Layout shell */
.deposit-shell { padding: 12px; }
.deposit-hero {
  background:;
  border: 1px solid #1c3a2f;
  border-radius: 18px;
  padding: 20px 22px;
  color: #e9fdf1;
  box-shadow: 0 18px 38px rgba(0,0,0,0.35);
}
.hero-badge {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 6px 12px; border-radius: 999px;
  background: rgba(124,255,110,0.12); color: #8bff7a; font-weight: 700; font-size: 12px;
}
.deposit-hero h1 { margin: 10px 0 4px; font-weight: 900; font-size: 28px; }
.deposit-hero p { margin: 0; color: #a8cbb8; }
.stepper {
  display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
  margin-top: 14px; font-weight: 700; color: #a8cbb8; font-size: 13px;
}
.stepper .dot {
  width: 28px; height: 28px; border-radius: 50%; display: inline-flex;
  align-items: center; justify-content: center;
  background: linear-gradient(135deg,#9dff71,#38f9c9); color: #053020; font-weight: 800;
  box-shadow: 0 10px 20px rgba(56,249,201,0.35);
}
.stepper .dot.inactive { background: #123127; color: #6d8f81; box-shadow: none; }
.stepper .sep { opacity: .4; }

/* Cards */
.card-pane, .section {
  background:;
  border: 1px solid #1e4636;
  border-radius: 16px;
  padding: 16px;
  color: #e9fdf1;
  box-shadow: 0 12px 30px rgba(0,0,0,0.32);
}
.section-title, .card-title { font-weight: 800; font-size: 16px; margin-bottom: 10px; color: #c5ffd9; }

/* Inputs */
.input-label { color: #a8cbb8; font-weight: 700; font-size: 13px; margin-bottom: 6px; display: block; }
.input-select select,
.box-input {
  width: 100%;
  background:;
  border: 1px solid #1f4e3a;
  color: #e9fdf1;
  border-radius: 12px;
  padding: 12px 14px;
}
.input-field { position: relative; }
.input-field .input-icon { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); }
.input-description { color: #7cf5c4; margin-top: 6px; font-size: 12px; }
.min-max { color: #ffc877; }

/* How-to pills */
.howto-bar { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px; }
.howto-pill {
  background: #103327;
  border: 1px solid #1f4e3a;
  color: #c5ffd9;
  padding: 10px 12px;
  border-radius: 12px;
  display: inline-flex; align-items: center; gap: 8px;
}
.howto-num {
  width: 22px; height: 22px; border-radius: 50%;
  background: #7cff6e; color: #063020; font-weight: 800;
  display: inline-flex; align-items: center; justify-content: center; font-size: 11px;
}

/* QR / wallet / proof */
.qr-slot { background: ; border: 1px solid #1f4e3a; border-radius: 12px; padding: 12px; min-height: 240px; }
.wallet-box { background:; border: 1px dashed #2f6f52; border-radius: 12px; padding: 12px; }
.wallet-box .label { color: #a8cbb8; font-weight: 700; font-size: 12px; margin-bottom: 6px; display: block; }

/* Manual/QR widgets from backend */
#manual-credentials .wallet-widget,
#manual-credentials .card-pane-lite {
  background:;
  border: 1px solid #1f4e3a !important;
  color: #e9fdf1 !important;
}
.wallet-widget .wallet-address { color: #e9fdf1 !important; }
.wallet-widget .copy-btn { background: #38f9c9 !important; color: #053020 !important; }

/* File box */
#manual-credentials .file-box,
#manual-fields .file-box{
  border:2px dashed #38f9c9;
  background:rgba(56,249,201,.08);
  border-radius:12px;
  padding:22px;
  text-align:center;
  position:relative;
  transition:background .2s, border-color .2s;
}
#manual-credentials .file-box:hover,
#manual-fields .file-box:hover{
  background:rgba(56,249,201,.12);
  border-color:#7cff6e;
}

/* Review list */
.review-list ul { list-style: none; padding: 0; margin: 0; }
.review-list li {
  display: flex; justify-content: space-between; align-items: center;
  padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.05);
  color: #d6f7e3;
}
.review-list li:last-child { border-bottom: none; }
.review-list .title { font-weight: 700; color: #a8cbb8; }
.review-list .info, .review-list .amount { font-weight: 800; color: #e9fdf1; }

/* Buttons */
.site-btn.gradient-btn {
  background: linear-gradient(135deg,#67e8f9 0%,#2563eb 100%) !important;
  color: #053020;
  font-weight: 900;
  border: none;
  box-shadow: 0 14px 26px rgba(56,249,201,0.3);
}
.site-btn.gradient-btn:hover { filter: brightness(1.05); }

/* Responsive */
@media (max-width: 991px) { .qr-wallet-grid { grid-template-columns: 1fr; } }
@media (max-width: 768px) {
  .deposit-hero { padding: 16px; }
  .card-pane { margin-bottom: 14px; }
}

/* =========================================================
   DEPOSIT PAGE - MOBILE TYPOGRAPHY + STRUCTURE REFINEMENT
   Paste BELOW your current deposit page CSS
========================================================= */

/* desktop/tablet: keep layout cleaner */
.qr-wallet-grid{
  display:grid;
  grid-template-columns: 1.15fr .95fr;
  gap:14px;
  align-items:start;
}

.deposit-shell{
  padding: 10px;
}

.deposit-hero{
  padding: 18px 20px;
  border-radius: 16px;
}

.deposit-hero h1{
  font-size: 24px;
  line-height: 1.15;
  margin: 8px 0 4px;
}

.deposit-hero p{
  font-size: 13px;
  line-height: 1.5;
}

.hero-badge{
  font-size: 11px;
  padding: 5px 10px;
}

.card-pane,
.section{
  padding: 14px;
  border-radius: 14px;
}

.card-title,
.section-title{
  font-size: 15px;
  margin-bottom: 8px;
}

.input-label{
  font-size: 12px;
  margin-bottom: 5px;
}

.input-select select,
.box-input{
  padding: 11px 13px;
  border-radius: 10px;
  font-size: 14px;
}

.input-description{
  font-size: 11px;
  line-height: 1.4;
}

.qr-pane h5,
.wallet-pane h5{
  font-size: 14px;
  margin-bottom: 8px;
  font-weight: 800;
  color: #c5ffd9;
}

.qr-slot{
  min-height: 210px;
  padding: 10px;
}

.wallet-box{
  padding: 10px;
}

.wallet-box .label{
  font-size: 11px;
}

.review-list li{
  padding: 9px 0;
}

.review-list .title{
  font-size: 12px;
}

.review-list .info,
.review-list .amount{
  font-size: 13px;
}

.site-btn.gradient-btn{
  min-height: 46px;
  font-size: 14px;
  border-radius: 12px;
}

/* =========================================================
   TABLET
========================================================= */
@media (max-width: 991px){
  .deposit-shell{
    padding: 8px;
  }

  .deposit-hero{
    padding: 16px 16px;
  }

  .deposit-hero h1{
    font-size: 21px;
  }

  .deposit-hero p{
    font-size: 12px;
  }

  .qr-wallet-grid{
    grid-template-columns: 1fr 1fr;
    gap:12px;
  }

  .card-pane{
    padding: 12px;
  }

  .card-title{
    font-size: 14px;
  }

  .qr-slot{
    min-height: 180px;
  }
}

/* =========================================================
   MOBILE - smaller text, keep some desktop structure
========================================================= */
@media (max-width: 768px){
  .deposit-shell{
    padding: 6px;
  }

  .deposit-hero{
    padding: 14px;
    border-radius: 14px;
  }

  .deposit-hero h1{
    font-size: 18px;
    line-height: 1.15;
    margin: 8px 0 3px;
  }

  .deposit-hero p{
    font-size: 11px;
    line-height: 1.45;
  }

  .hero-badge{
    font-size: 10px;
    padding: 5px 9px;
    gap: 6px;
  }

  .card-pane,
  .section{
    padding: 12px;
    border-radius: 12px;
    margin-bottom: 12px;
  }

  .card-title,
  .section-title{
    font-size: 13px;
    margin-bottom: 8px;
  }

  .input-label{
    font-size: 11px;
    margin-bottom: 4px;
  }

  .input-select select,
  .box-input{
    padding: 10px 12px;
    font-size: 13px;
    border-radius: 10px;
  }

  .input-description{
    font-size: 10px;
    line-height: 1.4;
    margin-top: 5px;
  }

  /* keep two-column feel on mobile instead of full collapse */
  .qr-wallet-grid{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap:10px;
  }

  .qr-pane h5,
  .wallet-pane h5{
    font-size: 12px;
    margin-bottom: 7px;
  }

  .qr-slot{
    min-height: 150px;
    padding: 8px;
    border-radius: 10px;
  }

  .wallet-box{
    padding: 8px;
    border-radius: 10px;
  }

  .wallet-box .label{
    font-size: 10px;
    margin-bottom: 5px;
  }

  #manual-credentials .file-box,
  #manual-fields .file-box{
    padding: 14px;
    border-radius: 10px;
  }

  .review-list li{
    padding: 8px 0;
    gap: 10px;
  }

  .review-list .title{
    font-size: 11px;
  }

  .review-list .info,
  .review-list .amount{
    font-size: 12px;
    text-align: right;
  }

  .rock-input-btn-wrap{
    margin-top: 12px !important;
  }

  .site-btn.gradient-btn{
    min-height: 42px;
    font-size: 13px;
    border-radius: 10px;
  }

  .site-btn.gradient-btn svg{
    width: 18px;
    height: 18px;
  }
}

/* =========================================================
   VERY SMALL PHONES
========================================================= */
@media (max-width: 480px){
  .deposit-shell{
    padding: 4px;
  }

  .deposit-hero{
    padding: 12px;
  }

  .deposit-hero h1{
    font-size: 16px;
  }

  .deposit-hero p{
    font-size: 10px;
  }

  .card-pane{
    padding: 10px;
  }

  .card-title{
    font-size: 12px;
  }

  .input-label{
    font-size: 10px;
  }

  .input-select select,
  .box-input{
    padding: 9px 10px;
    font-size: 12px;
  }

  /* on very small phones, stack only if needed */
  .qr-wallet-grid{
    grid-template-columns: 1fr;
    gap:10px;
  }

  .qr-pane h5,
  .wallet-pane h5{
    font-size: 11px;
  }

  .qr-slot{
    min-height: 140px;
  }

  .review-list .title{
    font-size: 10px;
  }

  .review-list .info,
  .review-list .amount{
    font-size: 11px;
  }

  .site-btn.gradient-btn{
    min-height: 40px;
    font-size: 12px;
  }
}

/* =========================================
   VIEW BARCODE BUTTON
========================================= */
.view-barcode-btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  min-height:42px;
  padding:0 16px;
  border:none;
  border-radius:12px;
  background:linear-gradient(135deg,#67e8f9 0%,#2563eb 100%) !important;
  color:#053020;
  font-weight:800;
  font-size:13px;
  box-shadow:0 12px 24px rgba(56,249,201,.22);
  transition:transform .2s ease, filter .2s ease;
}

.view-barcode-btn:hover{
  transform:translateY(-1px);
  filter:brightness(1.04);
}

/* =========================================
   BARCODE MODAL
========================================= */
.barcode-modal-overlay{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,.34);
  backdrop-filter:blur(8px);
  -webkit-backdrop-filter:blur(8px);
  display:flex;
  align-items:center;
  justify-content:center;
  padding:18px;
  z-index:9999;
  opacity:0;
  visibility:hidden;
  transition:opacity .22s ease, visibility .22s ease;
}

.barcode-modal-overlay.active{
  opacity:1;
  visibility:visible;
}

.barcode-modal-card{
  width:100%;
  max-width:460px;
  background:;
  border:1px solid #1f4e3a;
  border-radius:18px;
  padding:18px;
  box-shadow:0 20px 44px rgba(0,0,0,.38);
  position:relative;
  transform:translateY(10px) scale(.98);
  transition:transform .22s ease;
}

.barcode-modal-overlay.active .barcode-modal-card{
  transform:translateY(0) scale(1);
}

.barcode-close-btn{
  position:absolute;
  top:10px;
  right:10px;
  width:34px;
  height:34px;
  border:none;
  border-radius:10px;
  background:rgba(255,255,255,.06);
  color:#e9fdf1;
  font-size:22px;
  line-height:1;
  display:flex;
  align-items:center;
  justify-content:center;
}

.barcode-close-btn:hover{
  background:rgba(255,255,255,.10);
}

.barcode-modal-head h4{
  margin:0 0 4px;
  font-size:18px;
  font-weight:800;
  color:#e9fdf1;
}

.barcode-modal-head p{
  margin:0 0 14px;
  font-size:12px;
  color:#a8cbb8;
}

.barcode-modal-body{
  min-height:220px;
  display:flex;
  align-items:center;
  justify-content:center;
  border-radius:14px;
  background:;
  border:1px solid #1f4e3a;
  padding:14px;
}

.barcode-modal-body img,
.barcode-modal-body canvas{
  max-width:100%;
  height:auto;
  display:block;
}

.barcode-modal-empty{
  color:#a8cbb8;
  font-size:13px;
  text-align:center;
}

/* mobile */
@media (max-width:768px){
  .barcode-modal-card{
    max-width:380px;
    padding:14px;
    border-radius:16px;
  }

  .barcode-modal-head h4{
    font-size:16px;
  }

  .barcode-modal-head p{
    font-size:11px;
  }

  .barcode-modal-body{
    min-height:180px;
  }

  .view-barcode-btn{
    min-height:38px;
    padding:0 14px;
    font-size:12px;
  }
}

#manual-credentials .qr-holder,
#manual-credentials .qr-code,
#manual-credentials #qr{
  display:none !important;
}

.qr-pane .view-barcode-btn{
  margin-top: 12px;
  width: 100%;
}

.barcode-popup-inner{
  width:100%;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:10px;
}

.barcode-popup-image{
  max-width:100%;
  width:220px;
  height:auto;
  display:block;
  border-radius:12px;
  background:#fff;
  padding:10px;
}

@media (max-width:768px){
  .barcode-popup-image{
    width:190px;
    padding:8px;
    border-radius:10px;
  }
}

/* ========================================
   REDUCE UPLOAD PANEL SIZE
======================================== */

.wallet-pane h5{
  font-size: 12px !important;
  margin-bottom: 6px !important;
}

.wallet-box{
  padding: 8px !important;
  border-radius: 10px !important;
}

.wallet-box .label{
  font-size: 10px !important;
  margin-bottom: 4px !important;
}

#manual-fields{
  min-height: 72px !important;
}

#manual-credentials .file-box,
#manual-fields .file-box{
  padding: 12px !important;
  border-radius: 10px !important;
}

#manual-credentials .file-box .hint,
#manual-fields .file-box .hint{
  font-size: 10px !important;
  line-height: 1.3 !important;
}

#manual-credentials .file-box .chosen,
#manual-fields .file-box .chosen{
  font-size: 10px !important;
  margin-top: 6px !important;
}

/* mobile */
@media (max-width:768px){
  .wallet-box{
    padding: 7px !important;
  }

  #manual-fields{
    min-height: 64px !important;
  }

  #manual-credentials .file-box,
  #manual-fields .file-box{
    padding: 10px !important;
  }
}

/* =========================================================
   DEPOSIT PAGE - SIMPLE MOBILE LAYOUT
   Keeps barcode popup, removes compressed desktop feel
========================================================= */

@media (max-width: 768px){

  .deposit-shell{
    padding: 6px !important;
  }

  .deposit-hero{
    padding: 14px !important;
    border-radius: 14px !important;
  }

  .deposit-hero h1{
    font-size: 18px !important;
    line-height: 1.15 !important;
    margin: 8px 0 4px !important;
  }

  .deposit-hero p{
    font-size: 11px !important;
    line-height: 1.45 !important;
  }

  .hero-badge{
    font-size: 10px !important;
    padding: 5px 9px !important;
  }

  .card-pane,
  .section{
    padding: 12px !important;
    border-radius: 12px !important;
    margin-bottom: 12px !important;
  }

  .card-title,
  .section-title{
    font-size: 13px !important;
    margin-bottom: 8px !important;
  }

  .input-label{
    font-size: 11px !important;
    margin-bottom: 4px !important;
  }

  .input-select select,
  .box-input{
    padding: 10px 12px !important;
    font-size: 13px !important;
    border-radius: 10px !important;
  }

  .input-description{
    font-size: 10px !important;
    line-height: 1.4 !important;
    margin-top: 5px !important;
  }

  /* SIMPLE STACKED MOBILE LAYOUT */
  .qr-wallet-grid{
    display: grid !important;
    grid-template-columns: 1fr !important;
    gap: 10px !important;
  }

  .qr-pane,
  .wallet-pane{
    width: 100% !important;
  }

  .qr-pane h5,
  .wallet-pane h5{
    font-size: 12px !important;
    margin-bottom: 6px !important;
  }

  .qr-slot{
    min-height: 120px !important;
    padding: 8px !important;
    border-radius: 10px !important;
  }

  .wallet-box{
    padding: 8px !important;
    border-radius: 10px !important;
  }

  .wallet-box .label{
    font-size: 10px !important;
    margin-bottom: 4px !important;
  }

  #manual-fields{
    min-height: 64px !important;
  }

  .deposit-empty{
    min-height: 90px !important;
    font-size: 11px !important;
    padding: 12px !important;
    border-radius: 10px !important;
  }

  .deposit-loading{
    min-height: 100px !important;
    font-size: 11px !important;
  }

  .deposit-loading.small{
    min-height: 72px !important;
  }

  #manual-credentials .file-box,
  #manual-fields .file-box{
    padding: 10px !important;
    border-radius: 10px !important;
  }

  #manual-credentials .file-box .hint,
  #manual-fields .file-box .hint{
    font-size: 10px !important;
    line-height: 1.3 !important;
  }

  #manual-credentials .file-box .chosen,
  #manual-fields .file-box .chosen{
    font-size: 10px !important;
    margin-top: 6px !important;
  }

  .qr-pane .view-barcode-btn{
    width: 100% !important;
    margin-top: 10px !important;
    min-height: 38px !important;
    font-size: 12px !important;
    border-radius: 10px !important;
  }

  .review-list li{
    padding: 8px 0 !important;
    gap: 10px !important;
    align-items: flex-start !important;
  }

  .review-list .title{
    font-size: 11px !important;
  }

  .review-list .info,
  .review-list .amount{
    font-size: 12px !important;
    text-align: right !important;
  }

  .site-btn.gradient-btn{
    min-height: 42px !important;
    font-size: 13px !important;
    border-radius: 10px !important;
  }

  .site-btn.gradient-btn svg{
    width: 18px !important;
    height: 18px !important;
  }
}

@media (max-width: 480px){

  .deposit-shell{
    padding: 4px !important;
  }

  .deposit-hero{
    padding: 12px !important;
  }

  .deposit-hero h1{
    font-size: 16px !important;
  }

  .deposit-hero p{
    font-size: 10px !important;
  }

  .card-pane{
    padding: 10px !important;
  }

  .card-title{
    font-size: 12px !important;
  }

  .input-label{
    font-size: 10px !important;
  }

  .input-select select,
  .box-input{
    padding: 9px 10px !important;
    font-size: 12px !important;
  }

  .qr-slot{
    min-height: 100px !important;
  }

  .deposit-empty{
    min-height: 78px !important;
    font-size: 10px !important;
  }

  .review-list .title{
    font-size: 10px !important;
  }

  .review-list .info,
  .review-list .amount{
    font-size: 11px !important;
  }

  .site-btn.gradient-btn{
    min-height: 40px !important;
    font-size: 12px !important;
  }
}

/* DEPOSIT PAGE FINAL FIXES */

.deposit-empty,
.deposit-loading{
  min-height:110px;
  display:flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  padding:14px;
  border-radius:14px;
  background:rgba(25,43,73,.46);
  border:1px dashed rgba(125,211,252,.20);
  color:rgba(226,241,255,.58);
  font-size:12px;
  line-height:1.5;
}

.deposit-loading.small{
  min-height:82px;
}

.wallet-widget{
  padding:12px !important;
  border-radius:16px !important;
  background:rgba(25,43,73,.62) !important;
  border:1px solid rgba(125,211,252,.18) !important;
}

.wallet-widget .wallet-address{
  display:block;
  padding:10px;
  border-radius:12px;
  background:rgba(6,17,31,.52);
  border:1px solid rgba(125,211,252,.14);
  color:#eef8ff !important;
  font-size:12px;
  line-height:1.45;
  word-break:break-all;
}

.wallet-widget .copy-btn{
  min-height:36px;
  padding:0 12px;
  border-radius:11px;
  margin-top:8px;
  font-size:12px;
}

.qr-holder{
  display:flex;
  justify-content:center;
  align-items:center;
  padding:12px;
  margin:10px 0 12px !important;
  border-radius:14px;
  background:#ffffff;
}

.qr-holder canvas,
.qr-holder img{
  max-width:180px !important;
  width:100% !important;
  height:auto !important;
}

.input-field{
  position:relative;
}

.input-field .input-icon{
  position:absolute;
  right:12px;
  top:50%;
  transform:translateY(-50%);
  pointer-events:none;
}

.input-field .box-input{
  padding-right:46px !important;
}

.file-box{
  display:block;
  width:100%;
  cursor:pointer;
}

.file-box input[type="file"]{
  display:none;
}

.file-box .hint{
  color:rgba(226,241,255,.70);
  font-size:11px;
  line-height:1.4;
}

.file-box .chosen{
  display:none;
  margin-top:7px;
  color:#67e8f9;
  font-size:11px;
  font-weight:800;
  word-break:break-word;
}

.review-list .payment-method{
  object-fit:contain;
  border-radius:6px;
}

@media(max-width:768px){
  .deposit-empty,
  .deposit-loading{
    min-height:92px;
    font-size:11px;
    padding:12px;
  }

  .wallet-widget{
    padding:10px !important;
  }

  .wallet-widget .wallet-address{
    font-size:11px;
    padding:9px;
  }

  .qr-holder{
    padding:10px;
  }

  .qr-holder canvas,
  .qr-holder img{
    max-width:150px !important;
  }

  .barcode-modal-card{
    max-width:380px;
    padding:14px;
    border-radius:18px;
  }

  .barcode-modal-body{
    min-height:190px;
  }

  .barcode-popup-image{
    width:190px;
    padding:8px;
    border-radius:10px;
  }
}
</style>
@endpush

@section('content')
<div class="container-fluid default-page">
  <div class="deposit-shell">

    <div class="deposit-hero mb-3">
      <div class="hero-badge">
        <svg width="16" height="16" fill="none"><circle cx="8" cy="8" r="7" stroke="#7fc4ff" stroke-width="2"/><path d="M4.5 8l2.2 2L11.5 6" stroke="#7fc4ff" stroke-width="2" stroke-linecap="round"/></svg>
        {{ __('Secure Payment Gateway') }}
      </div>
      <h1>{{ __('Complete Your Deposit') }}</h1>
      <p>{{ __('Securely deposit funds.') }}</p>
      
    </div>

    <form action="{{ route('user.deposit.now') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row gy-20">
        <div class="col-xxl-7 col-xl-7 col-lg-7">
          <div class="card-pane">
            <div class="card-title">{{ __('Payment Details') }}</div>

            <div class="rock-single-input mb-3">
              <label class="input-label">{{ __('Payment Method') }}</label>
              <div class="input-select">
                <select name="gateway_code" id="gatewaySelect" class="site-nice-select">
                  <option selected disabled>--{{ __('Select Gateway') }}--</option>
                  @foreach($gateways as $gateway)
                    <option value="{{ $gateway->gateway_code }}">{{ $gateway->name }}</option>
                  @endforeach
                </select>
              </div>
              <p class="input-description charge"></p>
            </div>

            <div class="rock-single-input mb-3">
              <label class="input-label">{{ __('Amount to Deposit') }}</label>
              <div class="input-field">
                <input type="text" class="box-input" name="amount" id="amount" oninput="this.value = validateDouble(this.value)" aria-label="Amount">
                <span class="input-icon">
                  <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M22 12.5C22 18.0228 17.5228 22.5 12 22.5C6.47715 22.5 2 18.0228 2 12.5C2 6.97715 6.47715 2.5 12 2.5C17.5228 2.5 22 6.97715 22 12.5Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V7.85352C13.9043 8.17998 14.75 9.24122 14.75 10.5C14.75 10.9142 14.4142 11.25 14 11.25C13.5858 11.25 13.25 10.9142 13.25 10.5C13.25 9.80964 12.6904 9.25 12 9.25C11.3096 9.25 10.75 9.80964 10.75 10.5C10.75 11.1904 11.3096 11.75 12 11.75C13.5188 11.75 14.75 12.9812 14.75 14.5C14.75 15.7588 13.9043 16.82 12.75 17.1465V18C12.75 18.4142 12.4142 18.75 12 18.75C11.5858 18.75 11.25 18.4142 11.25 18V17.1465C10.0957 16.82 9.25 15.7588 9.25 14.5C9.25 14.0858 9.58579 13.75 10 13.75C10.4142 13.75 10.75 14.0858 10.75 14.5C10.75 15.1904 11.3096 15.75 12 15.75C12.6904 15.75 13.25 15.1904 13.25 14.5C13.25 13.8096 12.6904 13.25 12 13.25C10.4812 13.25 9.25 12.0188 9.25 10.5C9.25 9.24122 10.0957 8.17998 11.25 7.85352V7C11.25 6.58579 11.5858 6.25 12 6.25Z" fill="white"/>
                  </svg>
                </span>
              </div>
              <p class="input-description min-max"></p>
            </div>
<div class="qr-wallet-grid" id="qrWalletGrid">
  <div class="qr-pane">
    <h5>{{ __('SCAN QR Code') }}</h5>
 <button type="button" class="view-barcode-btn" id="openBarcodeModal" style="display:none;">
      {{ __('View Barcode') }}
    </button>
    <div class="qr-slot" id="manual-credentials">
      <div class="deposit-empty">Select a payment method to view wallet details and QR code.</div>
    </div>

   
  </div>

  <div class="wallet-pane" id="wallet-pane">
    <h5>{{ __('Wallet Address & Proof') }}</h5>
    <div class="wallet-box">
      <div class="label">{{ __('Upload Payment Proof') }}</div>
      <div id="manual-fields">
        <div class="deposit-empty">Upload proof after sending payment.</div>
      </div>
    </div>
  </div>
</div>

          </div>
        </div>

        <div class="col-xxl-5 col-xl-5 col-lg-5">
          <div class="card-pane h-100">
            <div class="card-title">{{ __('Review Details') }}</div>
            <div class="review-list">
              <ul>
                <li><span class="title">{{ __('Amount') }}</span> <span class="info"><span class="amount"></span> <span class="currency"></span></span></li>
                <li><span class="title">{{ __('Charge') }}</span> <span class="info charge2"></span></li>
                <li><span class="title">{{ __('Payment Method') }}</span> <span class="tumb" id="logo"><img src="" class="payment-method" style="height:28px;"></span></li>
                <li><span class="title">{{ __('Total') }}</span> <span class="title total"></span></li>
                <li><span class="title">{{ __('Conversion Rate') }}</span> <span class="info conversion-rate"></span></li>
                <li><span class="title">{{ __('Pay Amount') }}</span> <span class="info pay-amount"></span></li>
              </ul>
            </div>
            <div class="rock-input-btn-wrap justify-content-end mt-4">
              <button type="submit" class="site-btn gradient-btn radius-10 w-100">
                {{ __('Submit Deposit') }}
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path opacity="0.4" d="M19 13C19 17.4183 15.4183 21 11 21C6.58172 21 3 17.4183 3 13C3 8.58172 6.58172 5 11 5C15.4183 5 19 8.58172 19 13Z" fill="white"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16 3.75C15.5858 3.75 15.25 3.41421 15.25 3C15.25 2.58579 15.5858 2.25 16 2.25H21C21.4142 2.25 21.75 2.58579 21.75 3V8C21.75 8.41421 21.4142 8.75 21 8.75C20.5858 8.75 20.25 8.41421 20.25 8V4.81066L10.5303 14.5303C10.2374 14.8232 9.76256 14.8232 9.46967 14.5303C9.17678 14.2374 9.17678 13.7626 9.46967 13.4697L19.1893 3.75H16Z" fill="white"/>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>

<div class="barcode-modal-overlay" id="barcodeModal">
    <div class="barcode-modal-card">
        <button type="button" class="barcode-close-btn" id="closeBarcodeModal">&times;</button>

        <div class="barcode-modal-head">
            <h4>{{ __('Payment Barcode') }}</h4>
            <p>{{ __('Scan this barcode to complete your payment.') }}</p>
        </div>

        <div class="barcode-modal-body" id="barcodeModalBody">
            <div class="barcode-modal-empty">{{ __('No barcode available yet.') }}</div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
"use strict";

var globalData;
var currency = @json($currency);

function setDepositLoadingState() {
  $('#manual-credentials').html(`
    <div class="deposit-loading">
      Loading payment instructions...
    </div>
  `);

  $('#manual-fields').html(`
    <div class="deposit-loading small">
      Preparing upload section...
    </div>
  `);
}

function setDepositEmptyState() {
  $('#manual-credentials').html(`
    <div class="deposit-empty">
      Select a payment method to view wallet details and QR code.
    </div>
  `);

  $('#manual-fields').html(`
    <div class="deposit-empty">
      Upload proof after sending payment.
    </div>
  `);
}

function updateDepositTotals(data) {
  var amount = $('#amount').val();

  if (Number(amount) > 0) {
    $('.amount').text(Number(amount));
    $('.currency').text(currency);

    var charge = data.charge_type === 'percentage'
      ? calPercentage(amount, data.charge)
      : data.charge;

    $('.charge2').text(charge + ' ' + currency);

    var total = Number(amount) + Number(charge);
    $('.total').text(total + ' ' + currency);
    $('.pay-amount').text(total * data.rate + ' ' + data.currency);
  } else {
    $('.amount, .charge2, .total, .pay-amount').text('');
    $('.currency').text('');
  }
}

function bindAmountCalculation() {
  $('#amount').off('keyup.deposit input.deposit').on('keyup.deposit input.deposit', function () {
    if (!globalData) return;
    updateDepositTotals(globalData);
  });
}

$("#gatewaySelect").off('change.deposit').on('change.deposit', function (e) {
  e.preventDefault();

  const code = $(this).val();
  $('#openBarcodeModal').hide();
  if (!code) {
    setDepositEmptyState();
    return;
  }

  const url = '{{ route("user.deposit.gateway",":code") }}'.replace(':code', code);

  setDepositLoadingState();

  // keep layout stable always
  $('#wallet-pane').show();
  $('#qrWalletGrid').css('grid-template-columns', '');

  $.get(url)
    .done(function (data) {
      globalData = data;

      // side summary
      $('.charge').text('Charge ' + data.charge + ' ' + (data.charge_type === 'percentage' ? '%' : currency));
      $('.conversion-rate').text('1 ' + currency + ' = ' + data.rate + ' ' + data.currency);
      $('.min-max').text('Minimum ' + data.minimum_deposit + ' ' + currency + ' and Maximum ' + data.maximum_deposit + ' ' + currency);
      $('#logo').html(`<img class="payment-method" src="${data.gateway_logo}" style="height:28px;">`);

      updateDepositTotals(data);

      // render credentials
      var cred = (data && data.credentials)
        ? data.credentials
        : '<div class="deposit-empty">No payment instructions available yet.</div>';

      $('#manual-credentials').html(cred);

      // NEVER collapse the layout after selection
      const credHasFile = $('#manual-credentials').find('input[type="file"]').length > 0;

      if (credHasFile) {
        $('#manual-fields').html(`
          <div class="deposit-empty">
            Payment proof upload is already included in the instructions panel.
          </div>
        `);
      } else {
        $('#manual-fields').html(`
          <div class="deposit-empty">
            Upload proof after sending payment.
          </div>
        `);
      }
      
      ensureQrLib().then(() => {
  renderWalletQR();
  setTimeout(renderWalletQR, 80);
  setTimeout(dedupeQR, 120);
});

setTimeout(() => {
  const holder = document.querySelector('#manual-credentials .qr-holder');
  const qrCanvas = holder ? holder.querySelector('canvas') : null;
  const qrImg = holder ? holder.querySelector('img') : null;

  if (qrCanvas) {
    const imgSrc = qrCanvas.toDataURL('image/png');
    window.depositBarcodeModal?.setContent(`
      <div class="barcode-popup-inner">
        <img src="${imgSrc}" alt="Payment QR Code" class="barcode-popup-image">
      </div>
    `);
    $('#openBarcodeModal').css('display', 'inline-flex');
  } else if (qrImg) {
    window.depositBarcodeModal?.setContent(`
      <div class="barcode-popup-inner">
        <img src="${qrImg.src}" alt="Payment QR Code" class="barcode-popup-image">
      </div>
    `);
    $('#openBarcodeModal').css('display', 'inline-flex');
  } else {
    window.depositBarcodeModal?.setContent('');
    $('#openBarcodeModal').hide();
  }
}, 300);

  setTimeout(() => {
  const generatedQr = $('#manual-credentials').find('.qr-holder, canvas, img[alt*="QR"]').first();
  if (generatedQr.length) {
    window.depositBarcodeModal?.setContent(generatedQr.prop('outerHTML'));
    window.depositBarcodeModal?.showButton(true);
  }
}, 180);

      if (typeof imagePreview === 'function') imagePreview();
      enhanceFileInputs();
      bindAmountCalculation();
    })
    .fail(function () {
      $('#manual-credentials').html(`
        <div class="deposit-empty">
          Failed to load payment instructions. Please try again.
        </div>
      `);

      $('#manual-fields').html(`
        <div class="deposit-empty">
          Upload area will appear after payment instructions load successfully.
        </div>
      `);
    });
});

// initial state on page load
$(function () {
  setDepositEmptyState();
  bindAmountCalculation();

  const $gw = $('#gatewaySelect');
  const preset = $gw.find('option:selected').val();

  if (preset && preset !== 'disabled') {
    $gw.trigger('change');
  }
});
</script>

<script>
function dedupeQR(){
  const all = document.querySelectorAll(
    '#manual-credentials .qr-code, ' +
    '#manual-credentials [data-qr], '  +
    '#manual-credentials #qr, '        +
    '#manual-credentials canvas.qr, '  +
    '#manual-credentials img[alt*="QR"]'
  );
  let keptOne = false;
  all.forEach(el => {
    const insideOurHolder = el.closest('.qr-holder') !== null;
    if (insideOurHolder) { keptOne = true; return; }
    if (keptOne) { el.remove(); }
    else { keptOne = true; }
  });
}
</script>

<script>
// Load qrcode.js once (CDN)
let qrLibPromise;
function ensureQrLib(){
  if (window.QRCode) return Promise.resolve();
  if (qrLibPromise) return qrLibPromise;
  qrLibPromise = new Promise((resolve, reject) => {
    const s = document.createElement('script');
    s.src = 'https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js';
    s.onload = resolve;
    s.onerror = reject;
    document.head.appendChild(s);
  });
  return qrLibPromise;
}

// Read wallet address from the widget and render a QR
function renderWalletQR(){
  const wrap = document.querySelector('#manual-credentials .wallet-widget');
  if (!wrap) return;

  const addrEl = wrap.querySelector('[data-wallet], .wallet-address');
  const val = (addrEl?.getAttribute('data-wallet') || addrEl?.textContent || '').trim();
  if (!val) return;

  let holder = wrap.querySelector('.qr-holder');
  if (!holder) {
    holder = document.createElement('div');
    holder.className = 'qr-holder';
    holder.style.margin = '10px 0 14px';
    const last = wrap.lastElementChild;
    if (last) wrap.insertBefore(holder, last); else wrap.appendChild(holder);
  }
  holder.innerHTML = '';

  new QRCode(holder, {
    text: val,
    width: 200,
    height: 200,
    correctLevel: QRCode.CorrectLevel.M
  });
}
</script>

<script>
document.addEventListener('click', async (e) => {
  const btn = e.target.closest('.wallet-widget .copy-btn, .copy-btn');
  if (!btn) return;
  const wrap = btn.closest('.wallet-widget') || document;
  const el = wrap.querySelector('[data-wallet], .wallet-address, #walletAddress');
  const text = (el?.getAttribute('data-wallet') || el?.textContent || '').trim();
  if (!text) return;
  try { await navigator.clipboard.writeText(text); }
  catch {
    const t=document.createElement('textarea'); t.value=text; document.body.appendChild(t);
    t.select(); document.execCommand('copy'); t.remove();
  }
  const old = btn.textContent; btn.textContent = 'Copied! ✅';
  setTimeout(()=> btn.textContent = old, 1200);
});
</script>

<script>
function enhanceFileInputs(){
  $('#manual-credentials input[type="file"], #manual-fields input[type="file"]').each(function(){
    var $input = $(this);
    if ($input.data('boxed')) return;
    $input.data('boxed', true);

    var $group = $input.closest('.site-input-groups');
    var $origLabel = $group.find('label.box-input-label').first();
    var labelText = ($origLabel.text() || '').trim() || 'Upload file';

    $origLabel.attr({'aria-hidden':'true'}).css('display','none');
    $group.find('small, .input-description, .text-muted').hide();

    $input.attr('aria-label', labelText);

    var $box = $(`
      <label class="file-box">
        
        <div class="hint">Click here to upload (PNG, JPG, PDF)</div>
        <div class="chosen"></div>
      </label>
    `);
    $input.after($box);
    $box.prepend($input);

    $input.on('change', function(){
      var name = this.files && this.files.length ? this.files[0].name : '';
      var $chosen = $box.find('.chosen');
      if (name){ $chosen.text('Selected: ' + name).show(); }
      else { $chosen.hide(); }
    });
  });
}
</script>

<script>
(function () {
  const modal = document.getElementById('barcodeModal');
  const modalBody = document.getElementById('barcodeModalBody');
  const openBtn = document.getElementById('openBarcodeModal');
  const closeBtn = document.getElementById('closeBarcodeModal');

  function openBarcodeModal() {
    if (!modal) return;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeBarcodeModal() {
    if (!modal) return;
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }

  openBtn?.addEventListener('click', function () {
    openBarcodeModal();
  });

  closeBtn?.addEventListener('click', function () {
    closeBarcodeModal();
  });

  modal?.addEventListener('click', function (e) {
    if (e.target === modal) {
      closeBarcodeModal();
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeBarcodeModal();
    }
  });

  window.depositBarcodeModal = {
    setContent(html) {
      if (!modalBody) return;
      modalBody.innerHTML = html && html.trim()
        ? html
        : '<div class="barcode-modal-empty">No barcode available yet.</div>';
    },
    showButton(show = true) {
      if (!openBtn) return;
      openBtn.style.display = show ? 'inline-flex' : 'none';
    },
    close() {
      closeBarcodeModal();
    }
  };
})();
</script>
@endpush

@section('script')
@parent
@endsection