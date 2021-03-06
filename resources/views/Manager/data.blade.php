
@extends('Manager.layouts')
@section('main_content')
    <div class="col-md-12">
        <div class="content-panel">
            <h4><i class="fa fa-angle-right"></i> 图片新闻</h4><hr><table class="table table-striped table-advance table-hover">

                <thead>
                <tr>
                    <th><i class="fa fa-bullhorn"></i> 序号</th>
                    <th ><i class="fa fa-bookmark" ></i> 回答日期</th>
                    @foreach($questions as $keys => $val)
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> {{$val->topic}}</th>
                    @endforeach
                    <th><i class=" fa fa-edit"></i> 操作</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($answers as $key=>$value)
                    <tr >
                        <td class="hidden-phone">{{$key}}</td>
                        @foreach($value as $key1=>$val1)
                            @if($key1 == 'date')
                                    <td style="position:relative;">{{$val1['answer']}}</td>
                                @endif
                        @endforeach
                        @foreach($value as $key1=>$val1)
                            @if($key1 == 'date')

                            @elseif($val1->answer == null ||$val1 == null)
                                <td class="hidden-phone">
                                    无
                                </td>
                            @else
                                <td class="hidden-phone">
                                    {{$val1->answer}}
                                </td>
                            @endif
                        @endforeach
                        <td><a href="/manager/deleteAnswer/{{$key}}">删除</a>&nbsp;&nbsp;
                        </td>

                    </tr>
                    <tr>
                @endforeach

                </tbody>

            </table>
            {!! $submit->links() !!}
            {{--{{$answers->links()}}--}}
            <div class="shadowL"></div>
            <div class="shadowR"></div>
        </div><!-- /content-panel -->
    </div>
    <div id="ascrail2001" class="nicescroll-rails" style="width: 6px; z-index: 1000; background: rgb(64, 64, 64); cursor: default; position: fixed; top: 0px; height: 100%; right: 0px; opacity: 0;"><div style="position: relative; top: 215px; float: right; width: 6px; height: 544px; background-color: rgb(78, 205, 196); background-clip: padding-box; border-radius: 10px;"></div></div>
    </body>

@stop
@section('js')
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->

    <script>
        //custom select box

        $(function(){
            $('select.styled').customSelect();
        });

    </script>

@stop

