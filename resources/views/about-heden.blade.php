@extends('layouts.app')

@section('title')
    Heden Watercolor - {{ __('About') }}
@endsection

@section('styles')
@endsection

@section('content')
    @include('partials.messages')
    <h1 class="text-center mb-4">{{ __('About Heden') }}</h1>
    <div class="container my-3">
        <div class="row my-3 m-lg-0">

            <div class="col-md-6">
                <div class="d-flex justify-content-center mb-3">

                    <picture>
                        <source srcset="{{ asset('assets/images/about/heden-3.webp') }}" type="image/webp">
                        <source srcset="{{ asset('assets/images/about/heden-3.jpg') }}" type="image/jpeg">
                        <img class="w-100 my-3 my-lg-0" src="{{ asset('assets/images/about/heden-3.jpg') }}" alt="Image of a painting">
                    </picture>
                </div>
            </div>

            <div class="col-md-6 my-auto">
                <div>

                    {{__('La escritora española Ana María Matute, tituló “En el bosque” su discurso de ingreso en la Real Academia Española de la Lengua, en 1996.

                    El bosque era para la escritora un sinónimo del misterio, de lo inquietante, de las sombras y las luces, los monstruos que nos habitan, los miedos y esperanzas.
                    
                    El bosque es también en mis acuarelas un nido de experiencias. Y ese modo de entender mi labor como artista a través del bosque surgen todos los temas y paisajes, aunque sean desérticos.')}}
                </div>
            </div>

        </div>
        <div class="row  flex-wrap-reverse">

            <div class="col-md-6 my-auto">
                <div>
                    {{__('MI taller está en una buhardilla, sobre un paisaje de montañas y fiordos y con un gran bosque a sus espaldas. Aqui encuentro la paz que necesito para pintar y para expresarme.')}}
                </div>
            </div>

            <div class="col-md-6 mx-auto">
                <img src="{{ asset('assets/images/about/heden-2.jpg') }}" class="d-block w-75 p-3 m-auto my-3 my-lg-0" alt="{{__('Heden\'s workspace')}}">
            </div>

        </div>
        <div class="row">

            <div class="col-md-6 mx-auto">
                <img src="{{ asset('assets/images/about/heden-1.jpg') }}" class="d-block w-75 p-3 m-auto my-3 my-lg-0" alt="{{__('Photo of Heden')}}">
            </div>

            <div class="col-md-6 my-auto">
                <div>
                    <p>
                        {{__('Mi nombre es Herminia Delgado Nuñez, con las iniciales de mi nombre he creado mi nombre artistico, Heden, para no separar quien soy como persona de quien soy como artista. Yo no creco que el espiritu de un ser humano pueda desvincularse de su obra. No creo que un mal ser humano pueda crear una obra sensible o solidaria.')}}
                    </p>
                    <p>
                        {{__('Vivo entre Noruega y España y estos dos países tan diferentes son el espíritu de mis acuarelas.

                        La casa de la infancia en un pueblo de la Andalucia mas profunda, la alegre costa mediterrànea y el paisaje dramático de los fiordos conforman mi obra igual que me influyen a mi y mi formacion como ser humano. ')}}
                    </p>
                </div>
            </div>

        </div>
        <div class="col-lg-6 mx-auto">
            <h2 class="text-center my-5">{{ __('Contact with me') }}</h2>
            <form action="{{ route('contact-email-p') }}" method="POST" id="contact-form" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}*</label>
                    <input name="name" type="text" class="form-control" id="exampleFormControlInput1"
                        placeholder="{{ __('Write your name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}*</label>
                    <input name="email" type="email" class="form-control" id="exampleFormControlInput1"
                        placeholder="name@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="mensaje" class="form-label">{{ __('Message') }}*</label>
                    <textarea name="mensaje" class="form-control" id="mensaje" rows="3" required></textarea>
                </div>
                @include('partials.messages')
                @include('partials.privacy-check')
                * {{ __('Required fields') }}
                @include('partials.recaptcha')
                <div class="d-flex justify-content-center my-5">
                    <button class="btn btn-primary type=" submit">
                        {{ __('Send message') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
    @if (env('APP_ENV') != 'local')
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script>
            function onSubmit(token) {
                document.getElementById("contact-form").submit();
            }
        </script>
    @endif
@endsection
