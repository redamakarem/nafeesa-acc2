<form wire:submit.prevent="submit" class="pt-3">
    <table class="table table-index">
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



            @foreach($branches as $branch)
                <td>
{{--                    <span>{{$this->branch_fixedAssets[$branch->id][$fixedAsset->id]}}</span>--}}
                    <input type="text" name="" id="" wire:model="branch_fixedAssets.{{$fixedAsset->id}}.{{$branch->id}}">
                </td>
            @endforeach
            </tr>

        @endforeach

{{--        @for($i = 0; $i < $this->branch_count; $i++)--}}
{{--            <tr>--}}
{{--            @for($j = 0; $j < $this->asset_count; $j++)--}}
{{--                    <td><span>{{$this->branch_fixedAssets[$i][$j]}}</span></td>--}}
{{--                @endfor--}}
{{--            </tr>--}}
{{--        @endfor--}}
    </table>
    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</form>
