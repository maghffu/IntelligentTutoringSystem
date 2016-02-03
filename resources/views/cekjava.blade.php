<html>
<head>
    <title>Intelligent Tutoring Systems</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/materialize.css')}}" media="screen,projection">
</head>
<style type="text/css">
@font-face {
    font-family: 'Material Icons';
    font-style: normal;
    font-weight: 400;
    src: local('Material Icons'), local('MaterialIcons-Regular'), url({{asset('css/2fcrYFNaTjcS6g4U3t-Y5ZjZjT5FdEJ140U2DJYC3mY.woff2')}}) format('woff2');
}

.material-icons {
    font-family: 'Material Icons';
    font-weight: normal;
    font-style: normal;
    font-size: 24px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-feature-settings: 'liga';
    -webkit-font-smoothing: antialiased;
}
#editor {
    width: 50%;
    height: 50%;
}
</style>

<script type="text/javascript" src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/materialize.js')}}"></script>
<script src="{{asset('js/src/ace.js')}}"></script>
<body>
    <div class="row">

        <div class="well">
            <div class="col m5 s5">
                <div class="card-panel green accent-4">
                    <span class="white-text"><b>Petunjuk</b> latihan {!!$materi['judul_materi']!!}</span>
                </div>
            </div>
            <div class="col m7 s7">
                <div class="card-panel green accent-4">
                    <span class="white-text"><b>Text Editor</b> 
                        <button id="run" class="btn btn-raised right" >Run</button>
                        <button id="submit" class="btn btn-raised red right" onclick="seles()" <?php echo isset($selesai)?"":"disabled" ?>>Selesai</button>
                    </span>
                </div>
            </div>
            <div class="col m12 s12">
                <div class="col m5 s5" style="padding-left:0px;">
                    <div class="z-depth-2" style="height:80%; overflow: auto; padding-left:10px;">
                    {!! $panduan !!}
                    </div>
                </div>
                <div class="col m7 s7 ">
                    <div id="editor" class="col m12" style="width:100%;"></div>
                </div>
                <div class="col m7 s"><h6>Hasil</h6></div>
                <div class="col m7 s7" >
                    <div class="z-depth-2" id="status"  style="border: solid black 1px; height: 30%; padding:10px;">
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
<script type="text/javascript">
$(function(){

    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/java");
    editor.setOptions({
      fontSize: "12pt"
    });

    var sId = 0;
    var finish = false;

    var load = function(){
        var extra = '';
        if( finish ){
            extra = '&withSource=1&withInput=1&withOutput=1&withStderr=1&withCmpinfo=1'
        }
        var url = 'http://api.compilers.sphere-engine.com/api/3/submissions/' + sId + '/?access_token=ce03d68f7ba8413f15c33c37beef6371' + extra;
        $.ajax({url: url,
            type: 'get',
            dataType: 'json',
            success: function(data){

                if(!finish){
                    if(data['status'] != 0){
                        setTimeout(load, 1000);
                    } else {
                        finish = true;
                        setTimeout(load, 1);
                    }
                } else {
                    if (data.cmpinfo == "") {
                        $("#status").html(data.output);
                        var hs = data.output+"";
                        var harus = "{{$hasil}}";
                        console.log(hs.trim()+harus.trim());
                        console.log(hs == harus);
                        console.log(typeof hs);
                        console.log(typeof harus);
                        if ( hs.trim() == harus.trim()) {
                            $('#run').attr('disabled');
                            $('#submit').removeAttr('disabled');
                            berhasil();
                        };
                    }else{
                        $("#status").html("<div class='red-text'>"+data.cmpinfo+"</div>");
                    };
                    $("#run").html("Run");
                }
            },
            error: function(data){
                $("#status").html($('<span class="text-danger">Error</span>'));
            }
        });
        
    }

    $(document).on('click', '#run', function(){
        var url = 'http://api.compilers.sphere-engine.com/api/3/submissions/?access_token=ce03d68f7ba8413f15c33c37beef6371';
        var data = {
            'sourceCode': editor.getValue(),
            'language': 10,
            'input': $('#stdin').val()
        };
        sId = 0;
        finish = false;

        $("#run").html('<i class="material-icons">rotate_right</i> loading');
        $.ajax({url: url,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function(data){
                sId = data['id'];
                load();
            },
            error: function(data){
                $("#run").html("Error");
            }
        });
    });

});

function seles() {
    self.close();
}
function berhasil () {
    $.ajax({
        url: "{{url('mhs/latihan/selesai')}}"+"/"+"{{$id_log}}",
        success: function (data) {
            console.log(data);
            alert(data);
        }
    });
}
</script>   