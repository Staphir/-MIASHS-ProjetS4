$(document).ready(function(){
    function showSideBar() {
        $('.sideBar').css('width', '230');
        $('div#layer').fadeIn('fast');
        $('#hamburger').fadeOut('fast');
        $('#hamburger').finish();
        $('#hamburger').html('&times');
        $('#hamburger').fadeIn('fast');
    };
    function hideSideBar(){
        $('.sideBar').css('width', '0');
        $('div#layer').fadeOut('fast');
        $('#hamburger').fadeOut('fast');
        $('#hamburger').finish();
        $('#hamburger').html('☰');
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
        if (event.target.id == 'layer') {
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

    // Search automatic
    // $('#searchBox').on('input', function () {
    //     if (document.title == 'Storystoire - Rechercher') {
    //         // Do things
    //     }
    // });
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