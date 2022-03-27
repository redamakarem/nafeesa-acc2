<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.labor.title_singular') }}:
                    {{ trans('cruds.labor.fields.id') }}
                    {{ $labor->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.id') }}
                        </th>
                        <td>
                            {{ $labor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.title_en') }}
                        </th>
                        <td>
                            {{ $labor->title_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $labor->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.basic_salary') }}
                        </th>
                        <td>
                            {{ $labor->basic_salary }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.allowance') }}
                        </th>
                        <td>
                            {{ $labor->allowance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.total_salary') }}
                        </th>
                        <td>
                            {{ $labor->total_salary }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.indemnity_expenses') }}
                        </th>
                        <td>
                            {{ $labor->indemnity_expenses }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.leave_expenses') }}
                        </th>
                        <td>
                            {{ $labor->leave_expenses }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.flat_rent') }}
                        </th>
                        <td>
                            {{ $labor->flat_rent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.medical_insurance') }}
                        </th>
                        <td>
                            {{ $labor->medical_insurance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.visa_residency') }}
                        </th>
                        <td>
                            {{ $labor->visa_residency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.workers_insurance') }}
                        </th>
                        <td>
                            {{ $labor->workers_insurance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.uniform_expenses') }}
                        </th>
                        <td>
                            {{ $labor->uniform_expenses }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.total_cost') }}
                        </th>
                        <td>
                            {{ $labor->total_cost }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.labor.fields.cost_per_hour') }}
                        </th>
                        <td>
                            {{ $labor->cost_per_hour }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('labor_edit')
                    <a href="{{ route('admin.labors.edit', $labor) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.labors.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
