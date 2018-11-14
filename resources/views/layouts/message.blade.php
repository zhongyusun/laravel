<script>
    @if (session()->has('danger'))
            // 在hd.js里面组件，sweetalert    session   laraver自己定义的
    require(['hdjs'], function (hdjs) {
        hdjs.swal({
            text: "{{session()->get('danger')}}",
            button:false,
            icon:'warning'
        });
    })
    @endif
</script>



<script>
    @if (session()->has('success'))
    require(['hdjs'], function (hdjs) {
        hdjs.swal({
            text: "{{session()->get('success')}}",
            button:false,
            icon:'success'
        });
    })
    @endif
</script>

{{--手册表单验证，搜索errors--}}
<script>
    @if ($errors->any())
    require(['hdjs'], function (hdjs) {
        hdjs.swal({
            text: "@foreach ($errors->all() as $error) {{ $error }}\r\n @endforeach",
            button:false,
            icon:'warning'
        });
    })
    @endif
</script>