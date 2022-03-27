<table class="table table-index w-full">
    <thead>
    <tr>
        <th>Fixed Cost Elements</th>
        @foreach($branches as $branch)
            <th>{{$branch->title_en}}</th>
        @endforeach
    </tr>
    <tr>
        <th>No of shifts</th>
        @foreach($branches as $branch)
            <th>{{$branch->shifts}}</th>
        @endforeach
    </tr>
    <tr>
        <th>Total no of labor</th>
        @foreach($branches as $branch)
            <th>{{$branch->labor_count}}</th>
        @endforeach
    </tr>
    <tr>
        <th>Total Manhours</th>
        @foreach($branches as $branch)
            <th>{{$branch->total_manhours}}</th>
        @endforeach
    </tr>
    </thead>
    @foreach($fixedAssets as $fixedAsset)
        <tr>
            <th>{{$fixedAsset->title_en}}</th>
            @foreach($fixedAsset->branches as $branch)
                <td>
                    <div class="form-group">
{{--                        <input wire:model="assets.{{$fixedAsset->id}}.{{$branch->id}}"--}}
{{--                               class="form-control" type="text" data-asset="{{$fixedAsset->id}}"--}}
{{--                               data-branch="{{$branch->id}}" >--}}
                        <span>{{$branch->pivot->amount}}</span>
                    </div></td>
            @endforeach
        </tr>
    @endforeach
    <tr>
        <th>Total Fixed Cost</th>
        @foreach($branches as $branch)
            <th>{{$branch->fixedAssets->sum('pivot.amount')}}</th>
        @endforeach
    </tr>


</table>
