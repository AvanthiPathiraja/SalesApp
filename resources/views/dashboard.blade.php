<x-app-layout>
    <div>
        <noscript>You need to enable JavaScript to run this app.</noscript>
        <div id="root">



            <div class="relative md:ml-64 bg-blueGray-50">

                <div>
                    <a href="{{ route('invoice-payment.index') }}"> Invoice Payments  </a>
                </div>
                <div>
                    <a href="{{ route('invoice-return.index') }}"> Invoice Return  </a>
                </div>
                {{-- <div>
                    <a href="{{ route('issue-return.index') }}"> Issue Return  </a>
                </div>
                <div>
                    <a href="{{ route('discarded-stock.index') }}"> Discarded Stock  </a>
                </div> --}}

                <!-- Header -->
                <div class="relative bg-pink-700 md:pt-32 pb-32 pt-12">
                    <div class="px-4 md:px-10 mx-auto w-full">





                        <div>
                            <!-- Card stats -->
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                    <div
                                        class="relative flex flex-col min-w-0 break-words bg-gray-900 rounded mb-6 xl:mb-0 shadow-lg">
                                        <div class="flex-auto p-4">
                                            <div class="flex flex-wrap">
                                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                                    <h5 class="text-gray-400 uppercase font-bold text-xs">
                                                        Traffic
                                                    </h5>
                                                    <span class="font-semibold text-xl text-gray-300">
                                                        350,897
                                                    </span>
                                                </div>

                                                <div class="relative w-auto pl-4 flex-initial">
                                                    <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-700">
                                                        <i class="far fa-chart-bar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            </span>
                                            <span class="whitespace-nowrap text-gray-400">
                                                Since last month
                                            </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                    <div
                                        class="relative flex flex-col min-w-0 break-words bg-gray-900 rounded mb-6 xl:mb-0 shadow-lg">
                                        <div class="flex-auto p-4">
                                            <div class="flex flex-wrap">
                                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                                    <h5 class="text-gray-400 uppercase font-bold text-xs">
                                                        New users
                                                    </h5>
                                                    <span class="font-semibold text-xl text-gray-300">
                                                        2,356
                                                    </span>
                                                </div>
                                                <div class="relative w-auto pl-4 flex-initial">
                                                    <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-green-700">
                                                        <i class="fas fa-chart-pie"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-sm text-blueGray-400 mt-4">
                                                <span class="text-red-400 mr-2">
                                                    <i class="fas fa-arrow-down"></i> 3.48%
                                                </span>
                                                <span class="whitespace-nowrap text-gratext-gray-400">
                                                    Since last week
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>

</x-app-layout>
