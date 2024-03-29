@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="card bg-blueGray-100 w-full">
            <div class="card-header">
                <div class="card-row">
                    <h6 class="card-title">
                        Dashboard
                    </h6>
                </div>
            </div>

            <div class="card-body">
                <h5
                    class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
                    Sales</h5>
                <div class="grid grid-cols-12 gap-6">



                    <div
                        class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                        <div class="px-5 pt-5">

                            <h2 class="text-2xl font-semibold text-slate-800 mb-2">Transactions</h2>
                            <div class="flex items-start">
                                <div class="text-3xl font-bold text-slate-800 mr-2">{{ $data['transactions'] }}</div>
                            </div>
                        </div>
                        <div class="grow">
                            <canvas style="display: block; box-sizing: border-box; height: 128px; width: 472.667px;"
                                width="709" height="192"></canvas>
                        </div>
                    </div>
                    <div
                        class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                        <div class="px-5 pt-5">

                            <h2 class="text-2xl font-semibold text-slate-800 mb-2">Total Sales</h2>
                            <div class="flex items-start">
                                <div class="text-3xl font-bold text-slate-800 mr-2">K.D
                                    {{ number_format($data['total_sales'], 3, '.', ',') }}</div>
                            </div>
                        </div>
                        <div class="grow">
                            <canvas style="display: block; box-sizing: border-box; height: 128px; width: 472.667px;"
                                width="709" height="192"></canvas>
                        </div>
                    </div>
                    <div
                        class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                        <div class="px-5 pt-5">

                            <h2 class="text-2xl font-semibold text-slate-800 mb-2">Costs</h2>
                            <div class="flex items-start">
                                <div class="text-3xl font-bold text-slate-800 mr-2">K.D
                                    {{ number_format($data['costs'], 3, '.', ',') }}</div>
                            </div>
                        </div>
                        <div class="grow">
                            <canvas style="display: block; box-sizing: border-box; height: 128px; width: 472.667px;"
                                width="709" height="192"></canvas>
                        </div>
                    </div>
                    <div
                        class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                        <div class="px-5 pt-5">

                            <h2 class="text-2xl font-semibold text-slate-800 mb-2">Profits</h2>
                            <div class="flex items-start">
                                <div class="text-3xl font-bold text-slate-800 mr-2">K.D
                                    {{ number_format($data['profit'], 3, '.', ',') }}</div>
                            </div>
                        </div>
                        <div class="grow">
                            <canvas style="display: block; box-sizing: border-box; height: 128px; width: 472.667px;"
                                width="709" height="192"></canvas>
                        </div>
                    </div>


                </div>


                <h5
                    class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
                    Items</h5>
                <div class="grid grid-cols-12 gap-6">
                    <div
                        class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                        <div class="px-5 pt-5">

                            <h2 class="text-2xl font-semibold text-slate-800 mb-2">Raw Materials</h2>
                            <div class="flex items-start">
                                <div class="text-3xl font-bold text-slate-800 mr-2">{{ $data['raw_materials'] }} items</div>
                            </div>
                        </div>
                        <div class="grow">
                            <canvas style="display: block; box-sizing: border-box; height: 128px; width: 472.667px;"
                                width="709" height="192"></canvas>
                        </div>
                    </div>
                    <div
                        class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                        <div class="px-5 pt-5">

                            <h2 class="text-2xl font-semibold text-slate-800 mb-2">Semi Finished</h2>
                            <div class="flex items-start">
                                <div class="text-3xl font-bold text-slate-800 mr-2">{{ $data['semi_finished'] }} items</div>
                            </div>
                        </div>
                        <div class="grow">
                            <canvas style="display: block; box-sizing: border-box; height: 128px; width: 472.667px;"
                                width="709" height="192"></canvas>
                        </div>
                    </div>
                    <div
                        class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                        <div class="px-5 pt-5">

                            <h2 class="text-2xl font-semibold text-slate-800 mb-2">Finished</h2>
                            <div class="flex items-start">
                                <div class="text-3xl font-bold text-slate-800 mr-2">{{ $data['finished'] }} items</div>
                            </div>
                        </div>
                        <div class="grow">
                            <canvas style="display: block; box-sizing: border-box; height: 128px; width: 472.667px;"
                                width="709" height="192"></canvas>
                        </div>
                    </div>



                </div>
                <h5
                    class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
                    Top Products</h5>
                    <div class="grid grid-cols-12 gap-6">
                        <div
                            class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                            <div class="px-5 pt-5">
    
                                <h2 class="text-2xl font-semibold text-slate-800 mb-2">Per Quantity</h2>
                                <div class="flex items-start">
                                    <div class="text-3xl font-bold text-slate-800 mr-2">{{ $data['most_selling_quantity']->name_ar }} </div>
                                </div>
                                <div>Sales: {{ $data['most_selling_quantity']->total_sales }} </div>
                            </div>
                            <div class="grow">
                                <canvas style="display: block; box-sizing: border-box; height: 128px; width: 472.667px;"
                                    width="709" height="192"></canvas>
                            </div>
                        </div>
                        <div
                            class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                            <div class="px-5 pt-5">
    
                                <h2 class="text-2xl font-semibold text-slate-800 mb-2">Per Price</h2>
                                <div class="flex items-start">
                                    <div class="text-3xl font-bold text-slate-800 mr-2">{{ $data['most_selling_price']->name_ar }}</div>
                                </div>
                                <div>Amount: KD. {{ $data['most_selling_price']->total_price }} </div>
                            </div>
                            <div class="grow">
                                <canvas style="display: block; box-sizing: border-box; height: 128px; width: 472.667px;"
                                    width="709" height="192"></canvas>
                            </div>
                        </div>
                        <div
                            class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                            <div class="px-5 pt-5">
    
                                <h2 class="text-2xl font-semibold text-slate-800 mb-2">Per Profit</h2>
                                <div class="flex items-start">
                                    <div class="text-3xl font-bold text-slate-800 mr-2">{{ $data['most_selling_profit']->name_ar }}</div>
                                </div>
                                <div>Amount: KD. {{ $data['most_selling_profit']->total_profit }} </div>
                            </div>
                            <div class="grow">
                                <canvas style="display: block; box-sizing: border-box; height: 128px; width: 472.667px;"
                                    width="709" height="192"></canvas>
                            </div>
                        </div>
    
    
    
                    </div>
            </div>
        </div>
    </div>
@endsection
