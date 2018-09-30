@extends('layouts.app')
<style>
    input {
        height: 34px;
        width: 15%;
        text-align: center;
        border-radius: 3px;
        border: 1px solid transparent;
        border-top: none;
        border-bottom: 1px solid #DDD;
        box-shadow: inset 0 1px 2px rgba(0,0,0,.39), 0 -1px 1px #FFF, 0 1px 0 #FFF;
        margin-bottom: 5px;
    }
</style>


@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card text-center">
                    <div class="card-header">Resupply</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="POST" id="whatever">
                            <button type="button" id="checkout" class="btn btn-success">Show Orders</button>
                        </form>

                        <div id="id"></div><br>
                        <div id="lat"></div>
                        <div id="lng"></div>
                        <div id="cart"></div>




                        <div id="id" style="display: none"></div>
                        <div id="lat" style="display: none"></div>
                        <div id="lng" style="display: none"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">
        console.log("mesa");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // $('#checkout').click(function(event){
        //     console.log("fak");
        //
        //     $.get('manager_orders_ajax',{'_token':$('input[name=_token]').val()}, function(data){
        //         console.log(1);
        //         console.log(data);
        //     })
        // });
        $(document).on('click', '#checkout', function(){
            // $this.hide();
            console.log("fak");
            $.get("{{URL::to('manager/manager_orders_ajax')}}", function(){
                console.log("inout");
            }).done(function(data){
                var s = "1";
                $.each(data,function(index,subcatObj){
                    if(subcatObj.address == "marker"){
                        subcatObj.address = "Customer Chose address by marker";
                    }
                    console.log(subcatObj.cart.items[0]);
                    document.getElementById("id").innerHTML += "<br><br><p>Order : "+subcatObj.id+"<br>Address : "+subcatObj.address+"</p>";
                    for(var i=1; i < 11; i++){
                        if(typeof subcatObj.cart.items[i] !== 'undefined') {
                            document.getElementById("id").innerHTML += "<p> Items : "+ subcatObj.cart.items[i].item.title+"</p>";
                            console.log(subcatObj.cart.items[i]);
                        }
                    }
                });
            });
        });
    </script>

@endsection
