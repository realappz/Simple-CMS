<script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="js/beautify-html.js"></script>
<script type="text/javascript" src="js/posts.js"></script>

<link rel="stylesheet" href="css/posts.css" type="text/css">

<div class="toolbar">
    <div id="toolBar1"> 
        <select class="select" onchange="formatDoc('formatblock', this[this.selectedIndex].value);this.selectedIndex=0;">
            <option class="heading" selected>- formatting -</option>
            <option value="h1">Title 1 &lt;h1&gt;</option>
            <option value="h3">Title 3 &lt;h3&gt;</option>
            <option value="pre">Preformatted&lt;pre&gt;</option>
        </select>

        <select class="select" onchange="formatDoc('fontname', this[this.selectedIndex].value);this.selectedIndex=0;">
            <option class="heading" selected>- font -</option>
            <option>Arial</option>
            <option>Arial Black</option>
            <option>Courier New</option>
            <option>Times New Roman</option>
        </select>

        <select class="select" onchange="formatDoc('forecolor', this[this.selectedIndex].value);this.selectedIndex=0;">
            <option class="heading" selected>- color -</option>
            <option value="red">Red</option>
            <option value="blue">blue</option>
            <option value="green">Green</option>
            <option value="black">Black</option> 
        </select>

        <select class="select" onchange="formatDoc('backcolor', this[this.selectedIndex].value);this.selectedIndex=0;">
            <option class="heading" selected>- background -</option>
            <option value="red">Red</option>
            <option value="blue">blue</option>
            <option value="green">Green</option>
            <option value="black">Black</option> 
        </select>

        <select class="select" onchange="formatDoc(this.value)">
            <option class="heading" selected>- Functions -</option>
            <option value="italic">Italic</option>
            <option value="undo">Undo</option>
            <option value="redo">Redo</option>
            <option value="removeFormat">Remove Format</option>
            <option value="bold">Bold</option>
            <option value="underline">Underline</option>
            <option value="justifyleft">Left</option>
            <option value="justifycenter">Center</option>
            <option value="justifyright">Right</option>
            <option value="insertorderedlist">Number List</option>
            <option value="insertunorderedlist">Dotted List</option>
            <option value="indent">Indent</option>
            <option value="outdent">Delete Indent</option>
        </select>

        <button class="s_html">Show HTML</button>
    </div>
</div>

<div id="p_content" ondrop="drop(event)" ondragover="allowDrop(event)" contenteditable="true" type="text" placeholder="Content" name="p_content" value=""></div>

<div id="form_data">
    <input type="text" placeholder="Postname" name="p_postname" id="p_postname" label="" value="" />
    <input type="text" placeholder="Subject" name="p_subject" id="p_subject" label="" value="" />
    <input type="button" name="submit" id="posts_button" value2="" value="Create">
    <span class="status"></span>
</div>

<div id="posts"></div>

<script>
    $(document).on('click', ".s_html", function() {
        showHtml();
    })

    function showHtml() {
        const parent = document.getElementById("p_content");
        const cont = document.getElementById("p_content").innerHTML;

        const styleit = style_html(cont);

        const text = document.createTextNode(styleit);

        const v_html = document.createElement("div");
        v_html.setAttribute("class", "view_html");
        v_html.setAttribute("contenteditable", "true");

        const pre = document.createElement("pre");
        pre.appendChild(text);

        const close = document.createElement("dev");
        close.setAttribute("class", "close");

        const save = document.createElement("div");
        save.setAttribute("class", "save");

        parent.after(v_html);
        document.getElementsByClassName("view_html")[0].appendChild(pre);
        document.getElementsByClassName("view_html")[0].appendChild(close);
        document.getElementsByClassName("view_html")[0].appendChild(save);

        $(".save").css("postion","absolute")
        $(".save").css("right","0")
        $(".save").css("bottom","0")

        $(".close").html("x")
        $(document).on('click', ".close", function() {
            $(this).parent('.view_html').remove()
        })

        $(".save").html("Save")
        $(document).on('click', ".save", function() {
            const cont = $(this.parentNode.innerHTML);
            const moded = document.getElementById("p_content");

            document.getElementById("p_content").innerHTML = cont[0].innerText
        })
        

    }

    function formatDoc(sCmd, sValue) {
        var oDoc;
        oDoc = document.getElementById("p_content");
        document.execCommand(sCmd, false, sValue);
        oDoc.focus();
    }
</script>
