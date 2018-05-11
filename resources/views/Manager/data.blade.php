

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
                        <td class="hidden-phone">{{$key+1}}</td>
                        @foreach($value as $key1=>$val1)
                            @if($key1 == 'date')
                                 <td style="position:relative;">{{$val1->answer}}</td>
                            @endif
                                <td class="hidden-phone">
                                    @foreach($val1->answer as $key2 => $val2)
                                         {{$val1->answer[$key2]}}
                                    @endforeach
                                </td>
                        @endforeach

                        <td><a href="/manager/update_pic/{{$table}}/{{$value->id}}">修改</a>
                            <a href="/manager/delete/{{$table}}/{{$value->id}}" onclick= "javascript:return confirm('您确定要删除吗?')">删除</a>&nbsp;&nbsp;
                        </td>

                    </tr>
                    <tr>
                @endforeach

                </tbody>

            </table>
            {{$answers->links()}}
            <div class="shadowL"></div>
            <div class="shadowR"></div>
        </div><!-- /content-panel -->
    </div>
    </body>



