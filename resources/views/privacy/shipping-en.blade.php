@extends('layouts.app')

@section('title')
    {{ __('Portfolio') }}
@endsection

@section('styles')
    <link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
    <style>
        [data-custom-class='body'],
        [data-custom-class='body'] * {
            background: transparent !important;
        }

        [data-custom-class='title'],
        [data-custom-class='title'] * {
            font-family: Arial !important;
            font-size: 26px !important;
            color: #000000 !important;
        }

        [data-custom-class='subtitle'],
        [data-custom-class='subtitle'] * {
            font-family: Arial !important;
            color: #595959 !important;
            font-size: 14px !important;
        }

        [data-custom-class='heading_1'],
        [data-custom-class='heading_1'] * {
            font-family: Arial !important;
            font-size: 19px !important;
            color: #000000 !important;
        }

        [data-custom-class='heading_2'],
        [data-custom-class='heading_2'] * {
            font-family: Arial !important;
            font-size: 17px !important;
            color: #000000 !important;
        }

        [data-custom-class='body_text'],
        [data-custom-class='body_text'] * {
            color: #595959 !important;
            font-size: 14px !important;
            font-family: Arial !important;
        }

        [data-custom-class='link'],
        [data-custom-class='link'] * {
            color: #3030F1 !important;
            font-size: 14px !important;
            font-family: Arial !important;
            word-break: break-word !important;
        }

    </style>
    <style>
        ul {
            list-style-type: square;
        }

        ul>li>ul {
            list-style-type: circle;
        }

        ul>li>ul>li>ul {
            list-style-type: square;
        }

        ol li {
            font-family: Arial;
        }

    </style>
@endsection

@section('content')
    <div data-custom-class="body" class="p-3">
        <div>
            <div>
                <div><strong><span style="font-size: 26px;"><span data-custom-class="title">SHIPPING & DELIVERY
                                POLICY</span></span></strong></div>
                <div><br></div>
                <div><span style="color: rgb(127, 127, 127);"><strong><span style="font-size: 15px;"><span
                                    data-custom-class="subtitle">Last updated <bdt class="question">May 29, 2022
                                    </bdt></span></span></strong></span></div>
                <div><br></div>
                <div><br></div>
                <div><br></div>
                <div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span
                            style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text">
                                <bdt class="block-component"></bdt>
                            </span></span></span></span></span></span></span></span></span></div>
                <div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span
                            style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text">Please
                                carefully review our Shipping & Delivery Policy when purchasing our products. This policy
                                will apply to any order you place with us.</span></span></span></div>
                <div style="line-height: 1.5;"><br></div>
                <div style="line-height: 1.5;"><span data-custom-class="heading_1"><strong><span
                                style="color: rgb(127, 127, 127);"><span
                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                        data-custom-class="heading_1"><strong>WHAT ARE MY SHIPPING & DELIVERY
                                            OPTIONS?</strong></span></span></span></strong></span><span
                        style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                data-custom-class="body_text">
                                <bdt class="block-component">
                                    <bdt class="block-component">
                            </span></bdt></span></span></span></span></span></span></span><span
                        data-custom-class="body_text">
                        <bdt class="block-component"></bdt>
                    </span></span></span>
                    <bdt class="block-component"></bdt>
                    </bdt></span></span></span>
                </div>
                <div style="line-height: 1.5;"><br></div>
                <div style="line-height: 1.5;"><strong><span data-custom-class="heading_2">
                            <bdt class="block-component"></bdt>Shipping Fees
                        </span></strong></div>
                <div style="line-height: 1.5;"><br></div>
                <div>
                    <div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span
                                style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text">We
                                    <bdt class="block-component"></bdt>offer <bdt class="block-component"></bdt> shipping at
                                    the following rates:
                                </span><span data-custom-class="body_text">
                                    <bdt class="block-component"></bdt>
                                </span></span></span></div>
                    <div style="line-height: 1.5;"><br></div>
                    <table style="width: 44%; margin-right: calc(56%);">
                        <tbody>
                            <tr>
                                <td style="width: 57.8771%; border-bottom: 1px solid black;">
                                    <div style="text-align: center; line-height: 1;"><span
                                            style="color: rgb(127, 127, 127);"><span
                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                    data-custom-class="body_text"><strong>Shipping
                                                        Method</strong></span></span></span></div>
                                    <div style="text-align: center; line-height: 1;"><br></div>
                                </td>
                                <td style="width: 42.4261%; border-bottom: 1px solid black;">
                                    <div style="text-align: center; line-height: 1;"><span
                                            style="color: rgb(127, 127, 127);"><span
                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                    data-custom-class="body_text"><strong>Shipping
                                                        Fee</strong></span></span></span></div>
                                    <div style="text-align: center; line-height: 1;"><br></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="line-height: 1;"><span style="color: rgb(127, 127, 127);"><span
                            style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text">
                                <bdt class="forloop-component"></bdt>
                            </span></span></span></div>
                <table style="width: 44%; margin-right: calc(56%);">
                    <tbody>
                        <tr>
                            <td style="width: 57.8771%;">
                                <div style="text-align: center; line-height: 1;"><br></div>
                                <div style="text-align: center; line-height: 1;"><span
                                        style="color: rgb(127, 127, 127);"><span
                                            style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                data-custom-class="body_text">
                                                <bdt class="question">Standard (Spain)</bdt>
                                            </span></span></span></div>
                                <div style="text-align: center; line-height: 1.4;"><span
                                        style="color: rgb(127, 127, 127);"><span
                                            style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                data-custom-class="body_text">
                                                <bdt class="block-component"></bdt>
                                            </span></span></span></div>
                            </td>
                            <td style="width: 42.4261%; text-align: center; line-height: 1;"><br><span
                                    style="color: rgb(127, 127, 127);"><span
                                        style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                            data-custom-class="body_text">
                                            <bdt class="question">15€ (NOK 150)</bdt>
                                        </span></span></span></td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <div>
                        <div>
                            <div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span
                                        style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                            data-custom-class="body_text">
                                            <bdt class="forloop-component"></bdt>
                                        </span></span></span></div>
                            <table style="width: 44%; margin-right: calc(56%);">
                                <tbody>
                                    <tr>
                                        <td style="width: 57.8771%;">
                                            <div style="text-align: center; line-height: 1;"><br></div>
                                            <div style="text-align: center; line-height: 1;"><span
                                                    style="color: rgb(127, 127, 127);"><span
                                                        style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                            data-custom-class="body_text">
                                                            <bdt class="question">Standard (Norway)</bdt>
                                                        </span></span></span></div>
                                            <div style="text-align: center; line-height: 1.4;"><span
                                                    style="color: rgb(127, 127, 127);"><span
                                                        style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                            data-custom-class="body_text">
                                                            <bdt class="block-component"></bdt>
                                                        </span></span></span></div>
                                        </td>
                                        <td style="width: 42.4261%; text-align: center; line-height: 1;"><br><span
                                                style="color: rgb(127, 127, 127);"><span
                                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                        data-custom-class="body_text">
                                                        <bdt class="question">10€ (NOK 100)</bdt>
                                                    </span></span></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div>
                                <div>
                                    <div>
                                        <div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span
                                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                        data-custom-class="body_text">
                                                        <bdt class="forloop-component"></bdt>
                                                    </span></span></span><span style="color: rgb(127, 127, 127);"><span
                                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                        data-custom-class="body_text">
                                                        <bdt class="block-component">
                                                            <bdt class="block-component"></bdt>
                                                    </span></span></span></span></span></span></span></span></span></div>
                                        <div style="line-height: 1.5;"><br></div>
                                        <div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span
                                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                        data-custom-class="body_text">All times and dates given for
                                                        delivery of the products are given in good faith but are estimates
                                                        only.<bdt class="block-component"></bdt></span></span></span></div>
                                        <div style="line-height: 1.5;"><br></div>
                                        <div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span
                                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                        data-custom-class="body_text">For EU and UK consumers: This
                                                        does not affect your statutory rights. Unless specifically noted,
                                                        estimated delivery times reflect the earliest available delivery,
                                                        and deliveries will be made within 30 days after the day we accept
                                                        your order. For more information please refer to our Terms.<bdt
                                                            class="statement-end-if-in-editor"></bdt><span
                                                            style="color: rgb(127, 127, 127);"><span
                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                    data-custom-class="body_text">
                                                                    <bdt class="statement-end-if-in-editor">
                                                                        <bdt class="statement-end-if-in-editor"></bdt>
                                                                    </bdt>
                                                                </span></span></span></span><span
                                                        data-custom-class="body_text">
                                                        <bdt class="block-component">
                                                            <bdt class="block-component"></bdt>
                                                    </span></span></span></span></span></span></div>
                                        <div style="line-height: 1.5;"><br></div>
                                        <div>
                                            <div>
                                                <div>
                                                    <div>
                                                        <div>
                                                            <div>
                                                                <div>
                                                                    <div style="line-height: 1.5;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="heading_1"><strong>DO
                                                                                        YOU DELIVER
                                                                                        INTERNATIONALLY?</strong></span><span
                                                                                    data-custom-class="body_text">
                                                                                    <bdt class="statement-end-if-in-editor">
                                                                                        <bdt
                                                                                            class="statement-end-if-in-editor">
                                                                                            <bdt
                                                                                                class="statement-end-if-in-editor">
                                                                                                <span
                                                                                                    style="color: rgb(127, 127, 127);"><span
                                                                                                        style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                            data-custom-class="body_text">
                                                                                                            <bdt
                                                                                                                class="block-component">
                                                                                                            </bdt>
                                                                                                        </span></span></span>
                                                                                            </bdt>
                                                                                        </bdt>
                                                                                    </bdt>
                                                                                </span><span
                                                                                    data-custom-class="body_text">
                                                                                    <bdt class="block-component"></bdt>
                                                                                </span></span></span></span></span></span></span></span></span>
                                                                        <bdt class="block-component"></bdt>
                                                                        </bdt></span></span></span>
                                                                    </div>
                                                                    <div style="line-height: 1.5;"><br></div>
                                                                    <div style="line-height: 1.5;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text">We
                                                                                    offer international shipping to the
                                                                                    following countries:<bdt
                                                                                        class="forloop-component"></bdt>
                                                                                </span></span></span></div>
                                                                    <ul>
                                                                        <li style="line-height: 1.5;"><span
                                                                                style="color: rgb(127, 127, 127);"><span
                                                                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                        data-custom-class="body_text"><span
                                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                    data-custom-class="body_text">
                                                                                                    <bdt
                                                                                                        class="question">
                                                                                                        Spain</bdt>
                                                                                                </span></span></span></span></span></span>
                                                                        </li>
                                                                    </ul>
                                                                    <div style="line-height: 1.5;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text"><span
                                                                                        style="color: rgb(127, 127, 127);"><span
                                                                                            style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                data-custom-class="body_text">
                                                                                                <bdt
                                                                                                    class="forloop-component">
                                                                                                </bdt>
                                                                                            </span></span></span></div>
                                                                    <ul>
                                                                        <li style="line-height: 1.5;"><span
                                                                                style="color: rgb(127, 127, 127);"><span
                                                                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                        data-custom-class="body_text"><span
                                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                    data-custom-class="body_text">
                                                                                                    <bdt
                                                                                                        class="question">
                                                                                                        Norway</bdt>
                                                                                                </span></span></span></span></span></span>
                                                                        </li>
                                                                    </ul>
                                                                    <div style="line-height: 1.5;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text"><span
                                                                                        style="color: rgb(127, 127, 127);"><span
                                                                                            style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                data-custom-class="body_text">
                                                                                                <bdt
                                                                                                    class="forloop-component">
                                                                                                </bdt>
                                                                                            </span></span></span></span></span></span><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text">
                                                                                    <bdt class="block-component">
                                                                                        <bdt class="block-component"></bdt>
                                                                                        Free shipping is not valid on
                                                                                        international orders.<bdt
                                                                                            class="statement-end-if-in-editor">
                                                                                        </bdt>
                                                                                </span></span></span></div>
                                                                    <div style="line-height: 1.5;"><br></div>
                                                                    <div style="line-height: 1.5;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text"><span
                                                                                        style="color: rgb(127, 127, 127);"><span
                                                                                            style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                data-custom-class="body_text"><span
                                                                                                    style="color: rgb(127, 127, 127);"><span
                                                                                                        style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                            data-custom-class="body_text">
                                                                                                            <bdt
                                                                                                                class="statement-end-if-in-editor">
                                                                                                            </bdt>
                                                                                                        </span></span></span></span></span></span></span></span></span>
                                                                        <bdt class="block-component"><span
                                                                                data-custom-class="body_text"></bdt>
                                                                        </span></span></span></span></span></span></bdt>
                                                                        </span></span></span></span></span></span></bdt>
                                                                        </bdt></span></span></span>
                                                                        <bdt class="block-component"></bdt>
                                                                        </bdt></span></span></span>
                                                                    </div>
                                                                    <div style="line-height: 1.4;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text"><span
                                                                                        style="font-size: 15px; color: rgb(89, 89, 89);"><span
                                                                                            style="font-size: 15px; color: rgb(89, 89, 89);"><span
                                                                                                data-custom-class="body_text"><span
                                                                                                    style="color: rgb(127, 127, 127);"><span
                                                                                                        style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                            data-custom-class="body_text"><span
                                                                                                                style="color: rgb(127, 127, 127);"><span
                                                                                                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                                        data-custom-class="body_text">Please
                                                                                                                        note,
                                                                                                                        we
                                                                                                                        may
                                                                                                                        be
                                                                                                                        subject
                                                                                                                        to
                                                                                                                        various
                                                                                                                        rules
                                                                                                                        and
                                                                                                                        restrictions
                                                                                                                        in
                                                                                                                        relation
                                                                                                                        to
                                                                                                                        some
                                                                                                                        international
                                                                                                                        deliveries
                                                                                                                        and
                                                                                                                        you
                                                                                                                        may
                                                                                                                        be
                                                                                                                        subject
                                                                                                                        to
                                                                                                                        additional
                                                                                                                        taxes
                                                                                                                        and
                                                                                                                        duties
                                                                                                                        over
                                                                                                                        which
                                                                                                                        we
                                                                                                                        have
                                                                                                                        no
                                                                                                                        control.
                                                                                                                        If
                                                                                                                        such
                                                                                                                        cases
                                                                                                                        apply,
                                                                                                                        you
                                                                                                                        are
                                                                                                                        responsible
                                                                                                                        for
                                                                                                                        complying
                                                                                                                        with
                                                                                                                        the
                                                                                                                        laws
                                                                                                                        applicable
                                                                                                                        to
                                                                                                                        the
                                                                                                                        country
                                                                                                                        where
                                                                                                                        you
                                                                                                                        live
                                                                                                                        and
                                                                                                                        will
                                                                                                                        be
                                                                                                                        responsible
                                                                                                                        for
                                                                                                                        any
                                                                                                                        such
                                                                                                                        additional
                                                                                                                        costs
                                                                                                                        or
                                                                                                                        taxes.</span></span></span></span></span></span></span></span></span></span></span></span><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text"><span
                                                                                        style="color: rgb(127, 127, 127);"><span
                                                                                            style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                data-custom-class="body_text">
                                                                                                <bdt
                                                                                                    class="statement-end-if-in-editor">
                                                                                                    <bdt
                                                                                                        class="statement-end-if-in-editor">
                                                                                                        <bdt
                                                                                                            class="statement-end-if-in-editor">
                                                                                                        </bdt>
                                                                                                    </bdt>
                                                                                                </bdt>
                                                                                            </span></span></span>
                                                                                    <bdt class="else-block">
                                                                                        <bdt class="block-component">
                                                                                            <bdt class="block-component">
                                                                                            </bdt>
                                                                                        </bdt>
                                                                                    </bdt>
                                                                                </span></span></span></span></span></span>
                                                                    </div>
                                                                    <div style="line-height: 1.5;"><br></div>
                                                                    <div style="line-height: 1.5;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="heading_1"><strong>WHAT
                                                                                        HAPPENS IF MY ORDER IS
                                                                                        DELAYED?</strong></span></span></span>
                                                                    </div>
                                                                    <div style="line-height: 1.5;"><br></div>
                                                                    <div style="line-height: 1.5;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text">
                                                                                    <bdt class="block-component"></bdt>
                                                                                </span></span></span><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text">If
                                                                                    delivery is delayed for any reason we
                                                                                    will let you know as soon as possible
                                                                                    and will advise you of a revised
                                                                                    estimated date for
                                                                                    delivery.</span></span></span><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text">
                                                                                    <bdt
                                                                                        class="statement-end-if-in-editor">
                                                                                    </bdt>
                                                                                </span></span></span></div>
                                                                    <div style="line-height: 1.5;"><br></div>
                                                                    <div style="line-height: 1.5;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text">For
                                                                                    EU and UK consumers: This does not
                                                                                    affect your statutory rights. For more
                                                                                    information please refer to our
                                                                                    Terms.</span></span></span></div>
                                                                    <div style="line-height: 1.5;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text">
                                                                                    <bdt class="else-block">
                                                                                        <bdt class="block-component">
                                                                                            <bdt class="block-component">
                                                                                            </bdt>
                                                                                </span></span></span></span></span></span>
                                                                    </div>
                                                                    <div style="line-height: 1.5;"><br></div>
                                                                    <div style="line-height: 1.5;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="heading_1"><strong>HOW
                                                                                        CAN YOU CONTACT US ABOUT THIS
                                                                                        POLICY?</strong></span></span></span>
                                                                    </div>
                                                                    <div style="line-height: 1.5;"><br></div>
                                                                    <div style="line-height: 1.5;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text">If
                                                                                    you have any further questions or
                                                                                    comments, you may contact us
                                                                                    by:</span><span
                                                                                    data-custom-class="heading_1"><span
                                                                                        style="color: rgb(127, 127, 127);"><span
                                                                                            style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                data-custom-class="heading_1"><span
                                                                                                    style="color: rgb(127, 127, 127);"><span
                                                                                                        style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                            data-custom-class="body_text">
                                                                                                            <bdt
                                                                                                                class="block-component">
                                                                                                            </bdt>
                                                                                                            </bdt>
                                                                                                            </bdt>
                                                                                                        </span></span></span>
                                                                                                </bdt>
                                                                                            </span></span></span></span></span></span></span></span></span>
                                                                        </bdt></span></span></span></span><span
                                                                            data-custom-class="heading_1"><span
                                                                                style="color: rgb(127, 127, 127);"><span
                                                                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                        data-custom-class="heading_1"><span
                                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                    data-custom-class="body_text">
                                                                                                    <bdt
                                                                                                        class="block-component">
                                                                                                    </bdt>
                                                                                                    </bdt>
                                                                                                    </bdt>
                                                                                                </span></span></span></bdt>
                                                                                    </span></span></span></span></span></span></span></span></span>
                                                                        </bdt></span></span></span></span><span
                                                                            data-custom-class="body_text">
                                                                            <bdt class="statement-end-if-in-editor">
                                                                                <bdt class="block-component"></bdt>
                                                                            </bdt>
                                                                        </span></span></span></div>
                                                                    <ul>
                                                                        <li><span
                                                                                style="font-size: 15px; color: rgb(89, 89, 89);"><span
                                                                                    style="font-size: 15px; color: rgb(89, 89, 89);"><span
                                                                                        data-custom-class="body_text">Email:
                                                                                        <bdt class="question">
                                                                                            heden.watercolor@gmail.com</bdt>
                                                                                    </span></span></span></li>
                                                                    </ul>
                                                                    <div><span style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text"><span
                                                                                        style="color: rgb(127, 127, 127);"><span
                                                                                            style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                data-custom-class="body_text">
                                                                                                <bdt
                                                                                                    class="statement-end-if-in-editor">
                                                                                                    <span
                                                                                                        style="color: rgb(127, 127, 127);"><span
                                                                                                            style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                                data-custom-class="body_text"><span
                                                                                                                    style="color: rgb(127, 127, 127);"><span
                                                                                                                        style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                                            data-custom-class="body_text"><span
                                                                                                                                style="color: rgb(127, 127, 127);"><span
                                                                                                                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                                                        data-custom-class="body_text">
                                                                                                                                        <bdt
                                                                                                                                            class="block-component">
                                                                                                                                            <span
                                                                                                                                                style="color: rgb(127, 127, 127);"><span
                                                                                                                                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                                                                        data-custom-class="body_text">
                                                                                                                                                        <bdt
                                                                                                                                                            class="statement-end-if-in-editor">
                                                                                                                                                            <bdt
                                                                                                                                                                class="statement-end-if-in-editor">
                                                                                                                                                                <bdt
                                                                                                                                                                    class="statement-end-if-in-editor">
                                                                                                                                                                </bdt>
                                                                                                                                                            </bdt>
                                                                                                                                                        </bdt>
                                                                                                                                                    </span></span></span>
                                                                                                                                        </bdt>
                                                                                                                                    </span></span></span></span></span></span></span></span></span>
                                                                                                </bdt>
                                                                                            </span></span></span></span><span
                                                                                    data-custom-class="body_text"><span
                                                                                        style="color: rgb(127, 127, 127);"><span
                                                                                            style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                                data-custom-class="body_text">
                                                                                                <bdt
                                                                                                    class="statement-end-if-in-editor">
                                                                                                    <bdt
                                                                                                        class="statement-end-if-in-editor">
                                                                                                        <bdt
                                                                                                            class="block-component">
                                                                                                        </bdt>
                                                                                                    </bdt>
                                                                                                </bdt>
                                                                                            </span></span></span></span></span></span>
                                                                    </div>
                                                                    <ul>
                                                                        <li><span style="color: rgb(127, 127, 127);"><span
                                                                                    style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                        data-custom-class="body_text">Online
                                                                                        contact form: <bdt
                                                                                            class="question"><a
                                                                                                href="http://www.hedenwatercolor.com/support"
                                                                                                target="_blank"
                                                                                                data-custom-class="link">http://www.hedenwatercolor.com/support</a>
                                                                                        </bdt></span></span></span></li>
                                                                    </ul>
                                                                    <div style="line-height: 1.5;"><span
                                                                            style="color: rgb(127, 127, 127);"><span
                                                                                style="color: rgb(89, 89, 89); font-size: 15px;"><span
                                                                                    data-custom-class="body_text">
                                                                                    <bdt
                                                                                        class="statement-end-if-in-editor">
                                                                                    </bdt>
                                                                                </span></span></span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
