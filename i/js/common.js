/*
 * bootstrap 弹出
 */
$(function () {
    $("a[href='#myiframeModal']").click(function () {
        var width = 830;
        var height = 500;
        var calllback = "";
        if ($(this).attr("data-width") != undefined) {
            width = $(this).attr("data-width");
        }
        if ($(this).attr("data-height") != undefined) {
            height = $(this).attr("data-height");
        } 
        appendModel($(this).attr("title"), $(this).attr("data-url"), width, height)
    })
    
    /*
     * 非iframe
     * 
     */
     $("a[href='#contentModal']").click(function () {
        var width = 600;
        var height = 400;
        var calllback = "";
        if ($(this).attr("data-width") != undefined) {
            width = $(this).attr("data-width");
        }
        if ($(this).attr("data-height") != undefined) {
            height = $(this).attr("data-height");
        } 
        appendContent($(this).attr("title"), $(this).attr("data-content"), width, height)
    })
    
    /**
     * 统一删除提示
     */
    $("a[href='#del']").click(function(){
    	if(confirm("确认要删除 :"+ $(this).attr('title')+"?" )){
    		location.href = $(this).attr("data-url");
    	}
    })
    
})

function appendModel(title, src, width, height) {
    $("#myiframeModal").remove();
    if (!$("#myiframeModal")[0]) {
        $("body").append('<!-- Modal --><div id="myiframeModal" class="modal fade" tabindex="-1" role="dialog"  ><div class="modal-dialog" style="width:' + width + 'px; "><div class="modal-content" ><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-size:25px">×</span></button>               <h4 class="modal-title" id="myiframeModalLabel">' + title + '</h4></div><div class="modal-body"  style="max-height:'+(height+50)+'px;" ><iframe class="frame" src="' + src + '" style="width:100%;overflow-y:auto; height:'+height+'px;" frameborder="0"></iframe></div> <!-- / .modal-body --></div> <!-- / .modal-content --></div> <!-- / .modal-dialog --></div> <!-- /.modal --><!-- / Modal -->')  
    } 
}

function appendContent(title, content, width, height) {
    $("#contentModal").remove();
    if (!$("#contentModal")[0]) {
    	var modalStr = '<!-- Modal --><div id="contentModal" class="modal fade" tabindex="-1" role="dialog"  ><div class="modal-dialog" style="width:' + width + 'px; "><div class="modal-content" ><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-size:25px">×</span></button>               <h4 class="modal-title" id="myiframeModalLabel">' + title + '</h4></div><div class="modal-body"  style="height:'+(height+50)+'px;" >'+ decodeURIComponent(content)+'</div> <!-- / .modal-body --></div> <!-- / .modal-content --></div> <!-- / .modal-dialog --></div> <!-- /.modal --><!-- / Modal -->';
        $("body").append(modalStr)  
    } 
}