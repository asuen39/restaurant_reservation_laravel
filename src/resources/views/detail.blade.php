@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail__content">
    <div class="detail__inner">
        <div class="detail__list">
            <div class="detail__list-box">
                <section class="detail__shop">
                    <div class="detail__name-area">
                        <p class="detail__name-arrow-block">
                            <a href="/" class="detail__name-arrow arrow-left"><span></span></a>
                        </p>
                        <h4 class="detail__name">{{ $shops->shops_name }}</h4>
                    </div>
                    <div class="detail__image">
                        <img src="{{ asset($shops->image_path) }}" class="detail__image-thumbnail" alt="Shop Image">
                    </div>
                    <p class="case__name">
                        <span class="case__name-small">#{{ $shops->belongsToCountry->countries }}</span>
                        <span class="case__name-small">#{{ $shops->belongsToGenres->genres }}</span>
                    </p>
                    <p class="detail__text">{{ $shops->description }}</p>
                </section>
            </div>
            <div class="detail__list-box">
                <section class="detail__reservation">
                    <h4 class="detail__reservation-title">予約</h4>
                    <div class="datepicker">
                        <div class="datepicker__inner">
                            <input type="text" class="form-control" id="datepicker">
                            <span class="datepicker-icon"><i class="fa-regular fa-calendar fa-fw"></i></span>
                        </div>
                    </div>
                    <div class="detail__reservation-input">
                        <label class="detail__label">
                            <input type="text" class="form-control" id="reservation_time" name="reservation_time">
                        </label>
                    </div>
                    <div class="detail__reservation-input">
                        <label class="detail__label">
                            <select class="form-control" id="reservation_number" name="reservation_number">
                            </select>
                        </label>
                    </div>
                    <form class="" action="{{ route('showPaymentForm') }}" method="post">
                        <div class="detail__reservation-form">
                            @csrf
                            <ul class="detail__reservation-form-ul">
                                <li class="detail__reservation-list">
                                    <p class="detail__reservation-list-text left">Shop</p>
                                    <p class="detail__reservation-list-text">{{ $shops->shops_name }}</p>
                                    <input type="hidden" name="shop_id" value="{{ $shops->id }}">
                                </li>
                                <li class="detail__reservation-list">
                                    <p class="detail__reservation-list-text left">Date</p>
                                    <p class="detail__reservation-list-text">
                                        <span id="selected_date_display"></span>
                                    </p>
                                    <input type="hidden" name="reservation_date" id="selected_date_input">
                                </li>
                                @error('reservation_date')
                                <li class="detail__reservation-list">
                                    <p class="detail__reservation-alert">{{ $message }}</p>
                                </li>
                                @enderror
                                <li class="detail__reservation-list">
                                    <p class="detail__reservation-list-text left">Time</p>
                                    <p class="detail__reservation-list-text">
                                        <span id="selected_time_display"></span>
                                    </p>
                                    <input type="hidden" name="reservation_time" id="selected_time_input">
                                </li>
                                @error('reservation_time')
                                <li class="detail__reservation-list">
                                    <p class="detail__reservation-alert">{{ $message }}</p>
                                </li>
                                @enderror
                                <li class="detail__reservation-list">
                                    <p class="detail__reservation-list-text left">Number</p>
                                    <p class="detail__reservation-list-text">
                                        <span id="selected_number_display"></span>
                                    </p>
                                    <input type="hidden" name="reservation_number" id="selected_number_input">
                                </li>
                                @error('reservation_number')
                                <li class="detail__reservation-list">
                                    <p class="detail__reservation-alert">{{ $message }}</p>
                                </li>
                                @enderror
                            </ul>
                        </div>
                        <div class="detail__reservation-submit">
                            <button type="submit" class="detail__reservation-submit-text">予約する</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/detail.js') }}"></script>
@endsection