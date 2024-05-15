<div class="js-cookie-consent cookie-consent">

     @if(!Cookie::get('cookie-consent'))

        <script type="text/javascript">
            $(window).on('load', function() {
                $('#myModal').modal('show');
            });
        </script>

     <!--Cookies Modal -->
        <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                
                    <div class="modal-body">
                        <div class="card p-3 cookie"><span class="cookie-consent__message">{!! trans('cookieConsent::texts.message') !!}<br></span><a href="https://www.linde.com/cookie-policy">Learn more<i class="fa fa-angle-right ml-2"></i></a>
                            <div class="mt-4 text-right"><span class="mr-3 decline" data-dismiss="modal" aria-label="Close" style="cursor: pointer">Decline</span><button class="js-cookie-consent-agree cookie-consent__agree btn btn-success" data-dismiss="modal" aria-label="Close">{{ trans('cookieConsent::texts.agree') }}</button></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    @endif


</div>
