@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail__content">
    <div class="detail__inner">
        <div class="detail__list">
            <div class="detail__list-box">
                <div class="detail__name-area">
                    <p class="detail__name-arrow-block">
                        <a href="/" class="detail__name-arrow arrow-left"><span></span></a>
                    </p>
                    <h4 class="detail__name">{{ $shops->shops_name }}</h4>
                </div>
                <div>
                    <img src="{{ asset($shops->image_path) }}" class="shop_image-thumbnail" alt="Shop Image">
                </div>
                <p class="case__name">
                    <span class="case__name-small">#{{ $shops->belongsToCountry->countrys }}</span>
                    <span class="case__name-small">#{{ $shops->belongsToGenres->genres }}</span>
                </p>
                <p class="detail__text">{{ $shops->description }}</p>
            </div>
            <div class="detail__list-box">
                <section class="detail__reservation">
                    <h4 class="detail__reservation-title">予約</h4>
                    <div class="datepicker">
                        <input type="text" class="datepicker-input form-control" id="datepicker">
                        <span class="datepicker-icon"><i class="fa-regular fa-calendar fa-fw"></i></span>
                    </div>
                    <div class="detail__reservation-list">
                        <input type="text" class="form-control" id="reservation_time" placeholder="17:00">
                    </div>
                    <div class="detail__reservation-list">
                        <input type="text" class="form-control" id="reservation_number" placeholder="2">
                    </div>
                    <form class="" action="{{ route('makeReservation') }}" method="post">
                        <div class="detail__reservation-form">
                            @csrf
                            <ul class="detail__reservation-form-ul">
                                <li>
                                    Shop {{ $shops->shops_name }}
                                    <input type="hidden" name="shop_id" value="{{ $shops->id }}">
                                </li>
                                <li>
                                    Date: <span id="selected_date_display"></span>
                                    <input type="hidden" name="reservation_date" id="selected_date_input">
                                </li>
                                <li>
                                    Time: <span id="selected_time_display"></span>
                                    <input type="hidden" name="reservation_time" id="selected_time_input">
                                </li>
                                <li>
                                    Number: <span id="selected_number_display"></span>
                                    <input type="hidden" name="reservation_number" id="selected_number_input">
                                </li>
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