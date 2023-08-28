@if(count($milestones) > 0)
    @foreach($milestones as $mKey => $milestone)
        <div class="fs-sm push">
            <div class="d-flex justify-content-between mb-2">
                <div>
                    @if($milestone->status == 'paid' && !auth()->user()->isUserSubscibedToTheProduct($milestone->user_milestone_products()->pluck('product_id')->toArray()))
                    <a href="javascript:;" class="font-grayed fw-semibold">
                    @else
                    <a href="{{ route('milestone.detail',['milestone'=>$milestone->id]) }}" class="fw-semibold">
                    @endif
                        <i class="nav-main-link-icon fa fa-person"></i> 
                        {{ $milestone->name }}
                    </a>
                </div>
            </div>
            <div class="mb-2 verticalnum align-items-center">
                <div class="milvnum">
                    <span class="{{ $milestone->total_completed_module_per == 100 ? 'vnumbgcolorgreen' : 'vnumbgcolorgray' }}">{{ $mKey+1 }}</span>
                </div>
                <div class="vcontent">
                    <div class="card-body row" style="padding: 15px !important">
                        <div class="col-12 col-xl-8">
                            <div class="progress">
                                <div class="progress-bar " style="background-color: blue; width: {{$milestone->total_completed_task_per}}%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <p class="m-0">{{$milestone->total_completed_task_per}}% Task Complete</p>
                        </div>
                        <div class="col-12 col-xl-8">
                            <div class="progress">
                                <div class="progress-bar " style="background-color: blue; width: {{$milestone->total_completed_module_per}}%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <p class="m-0">{{$milestone->total_completed_module}}/{{$milestone->total_module}} Module Progress</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
<div class="no-data mb-4">
    No milestones found
</div>
@endif