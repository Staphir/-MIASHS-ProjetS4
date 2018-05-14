$(document).ready(function(){
    var path = $('#mainicon').attr('src');
    path = path.replace('icon.png', '');
    function showSideBar() {
        $('.sideBar').css('width', '226');
        $('div.layer').css('width', '100%');
        $('#hamburger').fadeOut('fast');
        $('#hamburger').finish();
        $('#hamburger').attr('src', path+'close.png');
        $('#hamburger').fadeIn('fast');
    };
    function hideSideBar(){
        $('.sideBar').css('width', '0');
        $('div.layer').css('width', '0%');
        $('#hamburger').fadeOut('fast');
        $('#hamburger').finish();
        $('#hamburger').attr('src', path+'sideBarMenu.png');
        $('#hamburger').fadeIn('fast');
    }
    $('#hamburger').click(function(){
        if ($('.sideBar').css('width') == '0px') {
            showSideBar();
        } else {
            hideSideBar();
        }
    });
    $(document).click(function(event){
        if (event.target.className == 'layer') {
            hideSideBar();
        }
    })
    $('#mainHeaderTitle').click(function(){
        var path = $('#mainicon').attr('src');
        path = path.replace('images/icon.png', 'index.php');
        window.location.replace(path);
    });

    // User Account Modal Window for Image Import
    $('#AccountImgModalBtn').click(function(){
        $('#AccountImgModal').show();
    });
    $('#closeImgModal').click(function(){
        $('#AccountImgModal').hide();
    });
    $(document).click(function(event){
        if (event.target.id == 'AccountImgModal') {
            $('#AccountImgModal').fadeOut('fast');
        }
    });
    $('#AccountImgUpload').change( function(e) {
        var img = URL.createObjectURL(e.target.files[0]);
        $('#AccountImg').attr('src', img);
        $('#AccountImg').show();
    });
    // ***


    // Story description
    //// description save button
    imgEnterLeave($('img#saveDesc'), '../images/save.png', '../images/saveActive.png')
    $('img#saveDesc').click(function(){
        HTMLText = $('textarea#textAreaDesc').val();
        StoryId = $('input#idStory').val();
        $.ajax({
            type: "POST",
            url: "../jquery/saveDescription.php",   
            data: {
                id:StoryId,
                description:HTMLText
            },
            success: function(result) {
                $('#container').html(result);
                $('#textAreaDesc').val(result);
                
                $('#textAreaDesc').hide();
                $('#container').show();

                $('img#editDescImg').attr('src', '../images/edit.png');
                alert('Description mise à jour.');
            }
        });
    });
    //// ***

    //// description edit button
    $('#editDescImg').click(function(){
        // modifyDescription();getDesc();
        var curHTML = $('#textAreaDesc').val();
        
        if ($('#container').is(":visible")) {
            $('#container').hide();
            $('#textAreaDesc').show();
        } else {
            $('#container').html(curHTML);
            $('#textAreaDesc').hide();
            $('#container').show();
        }
        imgSrcAlternate(this, '../images/edit.png', '../images/editActive.png')
    });
    //// ***
    // ***

    // Account data
    modifyAccountData('img#firstnameImg', 'input.firstname', 'p.firstname');
    modifyAccountData('img#lastnameImg', 'input.lastname', 'p.lastname');
    $('input#submitAccountData').click(function(){
        firstname = $('input.firstname').val();
        lastname = $('input.lastname').val();
        user_id = $('input#accountId').val();
        $.ajax({
            type: "POST",
            url: "jquery/saveAccountData.php",   
            data: {
                id:user_id,
                firstname:firstname,
                lastname:lastname,
            },
            success: function(result) {
                var data = JSON.parse(result);
                $('input.firstname').val(data[0]);
                $('input.lastname').val(data[1]);
                $('p.firstname').text(data[0]);
                $('p.lastname').text(data[1]);

                $('input.firstname').hide();
                $('input.lastname').hide();
                $('p.firstname').show();
                $('p.lastname').show();

                $('img#firstnameImg').attr('src', 'images/edit.png');
                $('img#lastnameImg').attr('src', 'images/edit.png');

                alert('Nom, Prénom mis à jour !');
            }
        });
    });
    // ***

    // Publish story
    $('#publishedCheckbox').click(function () {
        var published = $('#publishedCheckbox').prop('checked')?1:0;
        StoryId = $('input#idStory').val();
        $.ajax({
            type: "POST",
            url: "../jquery/publish.php",   
            data: {
                id:StoryId,
                published:published
            }
        });
        $('p#publishText').fadeOut(1);
        if (published) {
            $('p#publishText').text('Publiée');
        } else {
            $('p#publishText').text('Publier');
        }
        $('p#publishText').fadeIn();
    });
    // ***

    // Delete story
    $('img#deleteStory').click(function () {
        if (confirm("Etes-vous sûr(e) de vouloir supprimer cette histoire ? Une fois l'opération effectuée vous ne pourrez plus la récupérer.")) {
            StoryId = $('input#idStory').val();
            $.ajax({
                type: "POST",
                url: "../jquery/deleteStory.php",   
                data: {
                    id:StoryId
                },
                success: function () {
                    window.location.replace("my_stories.php");
                }
            });
        }
    });
    // ***

    // Read Story
    function insertStep (id, parent) {
        $.ajax({
            type: "POST",
            url: "jquery/get_step.php",   
            data: {
                id:id,
                parent:parent
            },
            success: function (result) {
                var data = JSON.parse(result);
                var HTMLstep = '';
                var HTMLchoices = '';
                if (!data[0].length) {
                    HTMLchoices = "<article class='card'><div><p>Bravo ! Vous avez fini cette histoire !</p></div></article>";
                } else {
                    HTMLstep = "<article class='card'><div><p>"+data[0][0]['content']+"</p></div></article>";
                    if (!data[1].length) {
                        HTMLchoices = "<article class='card'><div><p>Bravo ! Vous avez fini cette histoire !</p></div></article>";
                    } else {
                        for (var i = 0; i < data[1].length; i++) {
                            HTMLchoices += "<article class='card choice noselect'><div><input type='hidden' value='"+(data[1][i]['id'])+"'><p>"+data[1][i]['content']+"</p></div></article>";
                        }
                    }
                }
                $('div#storyContent').append(HTMLstep+HTMLchoices);
            }
        });
    };
    //// Start button
    $('button#read').click(function() {
        var id = $('input#readStoryId').val();
        insertStep(id, 0);
        $('button#read').attr('disabled', 'true');
        $('button#read').css('height', '0px');
        $('button#read').css('padding', '0px');
        $('button#read').css('margin', '0px');
        $('button#read').finish();
        $('div#storyContent').fadeIn('fast');
        $('button#read').fadeOut('fast');   
    });
    $('section div#storyContent').on('click', 'article.card.choice', function(){
        // récupérer id du choix cliqué
        var container = this;
        var parent = $(container).parent();
        var choice = container.firstChild.firstChild;
        var id_story = $('input#readStoryId').val();
        var id_choice = choice.value;
        if ($(container).attr('id') != 'clicked') {
            insertStep(id_story, id_choice);
            $(container).attr('id', 'clicked');
            $(container).css('cursor', 'auto');
            $(parent).children().each(function(){
                if ($(this).attr('id')!='clicked' && $(this).attr('class')!='card') {
                    $(this).attr('disabled', 'true');
                    $(this).fadeOut('fast');
                }
            });  
        }
    });
    // ***
});

function imgSrcAlternate(img, src1, src2) {
    var curSRC = $(img).attr('src');
    var newSRC = (curSRC == src1)?src2:src1;
    $(img).attr('src', newSRC);
}

function imgEnterLeave(img, src1, src2) {
    $(img).mouseenter(function(){
        $(this).attr('src', src2);
    });
    $(img).mouseleave(function(){
        $(this).attr('src',src1);
    });
}

function modifyAccountData (img, input, p) {
    $(img).click(function() {
        var curText = $(input).val();
        
        if ($(p).is(":visible")) {
            $(p).hide();
            $(input).show();
        } else {
            $(p).text(curText);
            $(input).hide();
            $(p).show();
        }
        imgSrcAlternate(this, 'images/edit.png', 'images/editActive.png')
    });
}