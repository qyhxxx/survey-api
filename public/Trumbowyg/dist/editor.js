
/**   编辑器配置说明   Configuration instructions  **/
/** 
   * ==========   btnsGrps.test=[],内增加模块内容解释：=========== 
   * bold:加粗 
   * link：链接 
   * formatting：格式化，排布大小方案 
   * btnGrp-semantic：字体的倾斜，加粗，中间划线 
   *justifyLeft：左对齐 
   *justifyCenter：居中 
   *justifyRight：右对齐 
   *justifyFull：两端对齐 
   *foreColor：字体颜色 
   *backColor：背景颜色 
   * 
   * ==========   btns: [],内增加模块内容解释：=========== 
   * 每个模块中间用'|'隔开 
   * 
   * btnGrp-test,        //试验，有此项，则会出现左对齐，居中，右对齐，两端对齐 
   * viewHTML,            //转换成html格式 
   * formatting,         //格式化，排布大小方案 
   * btnGrp-semantic,    //字体的倾斜，加粗，中间划线 
   * btnGrp-lists,       //list，前面加序号或者圆点符号 
   * image,              //图片 
   * horizontalRule     //增加分隔符 
   * 
   * 其他参数： 
   * lang: 语言选择 
   * autogrow: true,   //当编写长文本时，文本编辑区可以自行扩展,不会出现下拉条，默认值是false 
   * 
   **/
//=============================================================================================================  
$.trumbowyg.btnsGrps.editor = [
    'blod',
    'link',
    '|', 'justifyLeft',
    'justifyCenter',
    'justifyRight',
    'justifyFull','|',
    'foreColor',
    'backColor',
    'btnGrp-semantic'
];
$( '#editor' ).trumbowyg( {
    //设置中文  
    lang: 'zh_cn',
    //最大化：  
    fixedBtnPane: true,
    //autogrow: true,   //当编写长文本时，文本编辑区可以自行扩展,不会出现下拉条，默认值是false  
    //点击选择下拉  
    btnsDef: {
        //图片  
        image: {
            dropdown: [ 'insertImage', 'base64','upload' ],  // 'upload' 还有上传图片  
            ico: 'insertImage'
        }
    },
    btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers  
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
    ]
} );
$.extend( true, $.trumbowyg.langs, {
    fr: {
        align: 'Alignement',
        image: 'Image'
    }
} );
//配置php文件，上传的路径修改  
$.extend( true, $.trumbowyg.upload, {
    serverPath: './src/plugins/upload/trumbowyg_upload.php' /*服务器路径*/
} );
//=============================================================================================================  
/*  新增一個 button  作为  清空输入内容  */
function editor_reset() {
    $('#editor').trumbowyg('empty');  /*此方法为清空内容*/
} 