@extends('templates.restricted')
@section('headerTitle')
    {{ Auth::guard('users')->user()->cashier_stripe_users_name ? Auth::guard('users')->user()->cashier_stripe_users_name." Product List" : Auth::guard('users')->user()->cashier_stripe_users_email. " Product List" }}
@endsection

@section("header_styles")
<style type="text/css">
    .text-light {
        color: #ced4da !important;
        padding-top: 10px !important;
    }
.Click2Call th {
        text-align : center !important;
        vertical-align: middle !important;
    }
.Click2Call tbody tr td:last-child, td:first-child{
        text-align : center !important;
    }
.Click2Call tbody tr td.status{
        text-align : center !important;
    }
.productsRow > div {
  flex: 1;
  background: lightgrey;
  border: 1px solid grey;
  padding: 10px;
  margin-left: 5px;
}
</style>
<style>
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
@endsection

@section("main_content")
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Products List</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                              <li class="breadcrumb-item"><a href="{{ route('restricted.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('restricted.product.index') }}">Products</a></li>                          
                            </ol>
                        </nav>
                    </div>            
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
            @if(Session::has('vmessage'))
                <div class="row">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-text">{{Session::get('vmessage')}}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">

              <div class="col-6">
                <h3 class="mb-0">All Products List</h3>
              </div>

            </div><br>
            
            <?php
                $numberOfColumns = 3;
                $bootstrapColWidth = 12 / $numberOfColumns ;

                
                foreach($allProducts -> chunk($numberOfColumns) as $items) {
                    echo '<div class="row productsRow">';
                    foreach($items as $item) {
                        echo '<div class="col-md-'.$bootstrapColWidth.'">';
                        echo $item -> name."<br>";
                        echo $item -> price."<br>";
                        echo "<center><button type=button class='btn btn-primary buyNow' data-id ='".$item -> cashier_stripe_products_id."' data-name ='".$item -> name."' data-price = '".$item -> price."'>Buy Now</input></center>";
                        echo '</div>';
                    }
                    echo '</div><div class="row">&nbsp;</div>';
                }  
            ?>
            
        </div>
        <!-- Light table -->
        
    </div>
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification"></h6>
                </div>
                <div class="modal-body p-0">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-body">
                            <form method = "post" action = "" id="productFrm" class="productFrm">
                                @csrf
                                <input type="hidden" name="payment_method" class="payment-method">
                                <input type="hidden" name="price" class="price">
                                <input type="hidden" name="product" class="product">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <input class="StripeElement col-md-12" name="card_holder_name" id="card-holder-name" placeholder="Card holder name" required>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div id="card-element"></div>
                                    </div>
                                </div>
                                <div id="card-errors" role="alert"></div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary pay" id="card-button">
                                        Buy Now
                                    </button>
                                </div>                                      
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    
    <input type="hidden" class="site_url" value="@php echo URL::to('/'); @endphp" />
    <input type="hidden" class="url" value="{{ route('restricted.product.store') }}" />
    <script src="https://js.stripe.com/v3/"></script>
    <script>
    $(document).on("click", ".buyNow", function() {
         $(".card_holder_name").val("");
         $(".price").val($(this).attr("data-price"));
         $("#modal-form").find(".modal-title").text($(this).attr("data-name"));
         $("#modal-form").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
    let stripe = Stripe("{{env('STRIPE_KEY')}}");
    let elements = stripe.elements()
    let style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    }
    let card = elements.create('card', {style: style})
    card.mount('#card-element');
    let paymentMethod = null
    $('.productFrm').on('submit', function (e) {
        $('button.pay').attr('disabled', true)
        if (paymentMethod) {
            return true
        }
        stripe.confirmCardSetup(
            "{{ $intent->client_secret }}",
            {
                payment_method: {
                    card: card,
                    billing_details: {name: $('.card_holder_name').val()}
                }
            }
        ).then(function (result) {
            if (result.error) {
                $('#card-errors').text(result.error.message)
                $('button.pay').removeAttr('disabled')
            } else {
                paymentMethod = result.setupIntent.payment_method;
                $('.payment-method').val(paymentMethod);
                $('.productFrm').submit();
            }
        })
        return false
    })
</script>
@endsection

