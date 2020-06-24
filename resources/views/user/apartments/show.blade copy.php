@extends('layouts.app')
@section('content')
<<<<<<< HEAD
<div class="container">
    <div class="row">
        <div class="card col-8" >
            {{-- style="width: 18rem;" --}}
            {{-- immagine caricata come file --}}
            {{-- <img src="{{asset('storage/' . $apartment->img_path)}}" class="card-img-top" alt="{{$apartment->title}}"> --}}
            
            {{-- immagine caricata con la factory --}}
            <img src="{{asset($apartment->img_path)}}" class="card-img-top" alt="{{$apartment->title}}">
            <div class="card-body">
                <h5 class="card-title">{{$apartment->title}}</h5>
                <div class="">
                    <span>{{$apartment->rooms}}</span>
                </div>

                <div class="">
                    <span>{{$apartment->baths}}</span>
                </div>

                <div class="">
                    <span>{{$apartment->beds}}</span>
                </div>

                <div class="">
                    <span>{{$apartment->mq}}</span>
                </div>

                <div class="">
                    <p>{{$apartment->address}}</p>
                </div>

                @foreach ($apartment->services as $service)
                <div class="">
                    <p> {{$service->name}}</p>
                </div>
                @endforeach

                <a href="{{route('user.apartments.edit', $apartment->id)}}" class="btn btn-primary">Modifica</a>
                <form class="" action="{{route('user.apartments.destroy', $apartment->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input class="btn btn-danger" type="submit" name="" value="ELIMINA">
                </form>
                <a href="{{route('user.apartments.messages', $apartment->id)}}" class="btn btn-primary">Vedi i messaggi</a>
                <a href="{{route('user.apartments.stats', $apartment->id)}}" class="btn btn-primary">Vai alle statistiche</a>
            </div>
        </div>
   


        <div class="sponsorship-card card col-4">
            {{-- <form class="" action="{{ route('user.apartments.store_sponsoship') }}" method="post"> --}}
            {{-- <form class="" action="/user/store_sponsoship" method="post"> --}}
                {{-- @csrf
                @method('POST') --}}
                
                <input type="hidden" name="id" value="{{$apartment->id}}">
                <h3>Sponsorizza il tuo appartamento</h3>
                <p>Scegli il piano di sponsorizzazione piu adatto alle tue esigenze, e ottieni maggiore visibiltà nei risultati di ricerca.</p>
                @foreach ($sponsorship_packs as $sponsorship_pack)
                    @if ($sponsorship_pack->duration == 24)
                    <div class="form-check">
                        <input type="hidden" name="duration" value="{{$sponsorship_pack->duration}}">
                        <input class="form-check-input" type="radio" name="sponsorship" value="{{$sponsorship_pack->id}}" checked>
                        <label>{{$sponsorship_pack->price}}€ per {{$sponsorship_pack->duration}} ore</label>
                    </div>
                    @else 
                    <div class="form-check">
                        <input type="hidden" name="duration" value="{{$sponsorship_pack->duration}}">
                        <input class="form-check-input" type="radio" name="sponsorship" value="{{$sponsorship_pack->id}}">
                        <label>{{$sponsorship_pack->price}}€ per {{$sponsorship_pack->duration / 24}} giorni</label>
                    </div>  
                    @endif
                    
                    
                @endforeach
                    <button class="btn btn-primary active_sponsor_btn">Sponsorizza</button>
                    <div class="box-payment d-none">
                        <div id="dropin-container"></div>
                        <button type="submit" id="submit-button" class="btn btn-primary">Conferma pagamento</button>
                    </div>
            {{-- </form> --}}
        </div>

=======
<div class="container-fluid">
    <div class="row row-img">
        <img class="apt-image" src="{{asset('storage/' .$apartment->img_path)}}" alt="">
    </div>
    <div class="col-12">
        <div class="row container-margin">
          <h1 class="apt-title">{{$apartment->title}}</h1>
        </div>
        <div class="row container-margin">
          <h4 class="apt-address"><a href="http://www.google.com/maps/place/{{$apartment->latitude}},{{$apartment->longitude}}" target="_blank"><i class="fas fa-map-marker-alt"></i> {{$apartment->address}}</a></h4>
        </div>
        <hr>
    </div>
    <div class="row container-margin">
        <div class="col-8">
          <div class="apt-info">
            <span><i class="fas fa-door-open"></i> {{($apartment->rooms > 1) ? $apartment->rooms . ' Camere' : '1 Camera'}}</span>
            <span><i class="fas fa-bed"></i> {{($apartment->beds > 1) ? $apartment->beds . ' Letti' : '1 Letto'}}</span>
            <span><i class="fas fa-shower"></i> {{($apartment->baths > 1) ? $apartment->baths . ' Bagni' : '1 Bagno'}}</span>
            <span><i class="fas fa-home"> </i>{{$apartment->mq}}m<sup>2</sup></span>
          </div>



          <h4>Descrizione</h4>
          <p class="apt-description">
            {{$apartment->description}}
          </p>

          <h4>Servizi</h4>

          <div class="apt-services flex-info">

            @foreach ($apartment->services as $service)
                @if ($service->name == 'Sauna')
                <span><i class="fas fa-hot-tub"></i> {{$service->name}}</span>
                @elseif ($service->name == 'Piscina')
                <span><i class="fas fa-swimming-pool"></i> {{$service->name}}</span>
                @elseif ($service->name == 'Posto Auto')
                <span><i class="fas fa-car"></i> {{$service->name}}</span>
                @elseif ($service->name == 'Portineria')
                <span><i class="fas fa-concierge-bell"></i> {{$service->name}}</span>
                @elseif ($service->name == 'Vista Mare')
                <span><i class="fas fa-water"></i> {{$service->name}}</span>
                @elseif ($service->name == 'WiFi')
                <span><i class="fas fa-wifi"></i> {{$service->name}}</span>
                @endif
            @endforeach
          </div>
          <div class="controls">
              <a href="{{route('user.apartments.edit', $apartment->id)}}" class="btn btn-edit btn-primary">Modifica</a>
              <form class="" action="{{route('user.apartments.destroy', $apartment->id)}}" method="post">
                  @method('DELETE')
                  @csrf
                  <input class="btn btn-danger" type="submit" name="" value="Elimina">
              </form>


          </div>
        </div>







        <div class="row">
            <div class="col-md-8 col-md-offset-2 payment">
                {{-- <form class="" action="{{ route('user.apartments.store_sponsoship') }}" method="post"> --}}
                {{-- <form class="" action="/user/store_sponsoship" method="post"> --}}
                    {{-- @csrf
                    @method('POST') --}}


                    <input type="hidden" name="id" value="{{$apartment->id}}">


                    <div class="options">
                    
                        <p ><i class="fas fa-chart-line"></i> Highlight your apartment</p>

                        @foreach ($sponsorship_packs as $sponsorship_pack)
                            <div class="form-check">
                                <input type="hidden" name="duration" value="{{$sponsorship_pack->duration}}">
                                <input class="form-check-input" type="radio" name="sponsorship" value="{{$sponsorship_pack->id}}">
                                <label>{{$sponsorship_pack->price}} Euro per {{$sponsorship_pack->duration}} ore</label>
                            </div>
                        @endforeach

                    </div>

                    <div class="paypal">

                        <div id="dropin-container"></div>
                        <button type="submit" id="submit-button">Checkout</button>

                    </div>
                {{-- </form> --}}
            </div>
        </div>
>>>>>>> lorelulli
    </div>
    <script>
        //======= visualizzazione box pagamento
        $('button.active_sponsor_btn').on('click', function () {
           
            $('.box-payment').removeClass("d-none");
        });
        //=======
        var button = document.querySelector('#submit-button');

        braintree.dropin.create({
            //===============!!!!!!!!! DA GENERARE E CAMBIARE !!!!!!!!!==================
            authorization: "sandbox_zjfh858v_q3x76bj5z6dt98t9",
            //===============!!!!!!!!! DA GENERARE E CAMBIARE !!!!!!!!!==================

            container: '#dropin-container'
        }, function (createErr, instance) {
            button.addEventListener('click', function () {
                // event.preventDefault()
            // button.click(function(event) {
            //     event.preventDefault();
                instance.requestPaymentMethod(function (err, payload) {
                    $.get('{{ route('payment.make') }}', {payload}, function (response) {
                        if (response.success) {
                            alert('Payment successfull!');

                            var radioValue = $("input[name='sponsorship']:checked").val();
                            // console.log('radio value: ' + radioValue);
                            var apartmentId = $("input[name='id']").val();
                            // console.log('apartment id: ' + apartmentId);
                            // var duration = $("input[name='duration']:checked").val();

                            // console.log(duration);

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                                }
                            });

                            $.ajax({
                                url: '/user/store_sponsoship',
                                type: 'post',
                                // async:false,
                                // dataType: "json",
                                data: {

                                    radioVal: radioValue,
                                    apartId: apartmentId
                                    // duration: duration
                                },
                                success: function (data) {
                                    console.log('data: ',  data);
                                },
                                error: function (data) {
                                    console.log('Error:', data);

                                }
                            });

                        } else {
                            alert('Payment failed');
                        }
                    }, 'json');
                });


                // $.ajax({
                //     url: '/store_sponsoship',
                //     method: 'POST',
                //     // async:false,
                //     dataType: "json",
                //     data: {
                //
                //         radioVal: radioValue,
                //         apartmentId: apartmentId
                //     },
                //     success: function (data) {
                //         console.log('data: ',  data);
                //     },
                //     error: function (data) {
                //         console.log('Error:', data);
                //
                //     }
                // });
            });
        });
    </script>

</div>

@endsection

{{-- @if (isset($data))

    var_dump($data);

@endif --}}