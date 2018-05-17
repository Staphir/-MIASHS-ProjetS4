$(document).ready(function(){
    var root = $('#hamburger').attr('src');
    root = root.replace('images/sideBarMenu.png', '');

    function showSideBar() {
        $('.sideBar').css('width', '226');
        $('div.layer').css('width', '100%');
        $('#hamburger').fadeOut('fast');
        $('#hamburger').finish();
        $('#hamburger').attr('src', root+'images/close.png');
        $('#hamburger').fadeIn('fast');
    };
    function hideSideBar(){
        $('.sideBar').css('width', '0');
        $('div.layer').css('width', '0%');
        $('#hamburger').fadeOut('fast');
        $('#hamburger').finish();
        $('#hamburger').attr('src', root+'images/sideBarMenu.png');
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
        window.location.replace(root+'index.php');
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
        $.ajax({
            type: "POST",
            url: "../jquery/saveDescription.php",   
            data: {
                id:storyId,
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
            $('#textAreaDesc').show('fast');
        } else {
            $('#container').html(curHTML);
            $('#textAreaDesc').hide('fast');
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
        $.ajax({
            type: "POST",
            url: "jquery/saveAccountData.php",   
            data: {
                id:user_id,
                firstname:firstname,
                lastname:lastname
            },
            success: function(result) {
                console.log(result)
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
    $('input.publishCheckbox').click(function () {
        var published = $(this).prop('checked')?1:0;
        $.ajax({
            type: "POST",
            url: "../jquery/publish.php",   
            data: {
                id:storyId,
                published:published
            }
        });
        $('.publishText').fadeOut(1);
        if (published) {
            $('.publishText').text('Publiée');
        } else {
            $('.publishText').text('Publier');
        }
        $('.publishText').fadeIn();
    });
    // ***

    // Delete story
    $('img.deleteStory').click(function () {
        if (confirm("Etes-vous sûr(e) de vouloir supprimer cette histoire ? Une fois l'opération effectuée vous ne pourrez plus la récupérer.")) {
            $.ajax({
                type: "POST",
                url: "../jquery/deleteStory.php",   
                data: {
                    id:storyId
                },
                success: function () {
                    window.location.replace("my_stories.php");
                }
            });
        }
    });
    // ***

    // Read Story
    function insertStep(parent) {
        $.ajax({
            type: "POST",
            url: "jquery/get_step.php",   
            data: {
                id:storyId,
                parent:parent
            },
            success: function (result) {
                var data = JSON.parse(result);
                var HTMLstep = '';
                var HTMLchoices = '';
                if (!data[0].length) {
                    HTMLchoices = "<div><article class='card'><div><p>Bravo ! Vous avez fini cette histoire !</p></div></article></div>";
                } else {
                    HTMLstep = "<div><article class='card step'><div><p>"+data[0][0]['content']+"</p></div></article>";
                    if (!data[1].length) {
                        HTMLchoices = "<article class='card'><div><p>Bravo ! Vous avez fini cette histoire !</p></div></article><div>";
                    } else {
                        for (var i = 0; i < data[1].length; i++) {
                            HTMLchoices += "<article class='card choice noselect'><div><input type='hidden' value='"+(data[1][i]['id'])+"'><p>"+data[1][i]['content']+"</p></div></article>";
                        }
                        HTMLchoices += "</div>";
                    }
                }
                $('div#storyContent').append(HTMLstep+HTMLchoices);
            }
        });
    };

    // Start button
    $('button#read').click(function() {
        insertStep(0);
        $('button#read').attr('disabled', 'true');
        $('button#read').css('height', '0px');
        $('button#read').css('padding', '0px');
        $('button#read').css('margin', '0px');
        $('div#storyContent').fadeIn('fast');
        $('button#read').fadeOut('fast');

    });

    // callback sur les choix
    $('#storyContent').on('click', 'div article.choice', function(){
        // récupérer id du choix cliqué
        var container = this;
        var parent = $(container).parent();
        var choice = container.firstChild.firstChild;
        var id_choice = choice.value;
        if (!$(container).hasClass('clicked')) {
            insertStep(id_choice);
            $(container).addClass('clicked');
            $(container).css('cursor', 'auto');
            $(parent).children().each(function(){
                if (!$(this).hasClass('clicked') && $(this).attr('class')!='card step') {
                    $(this).attr('disabled', 'true');
                    $(this).fadeOut('fast')
                }
            });  
        }
    });

    function hideStartBtn() {
        $('button#read').attr('disabled', 'true');
        $('button#read').css('height', '0px');
        $('button#read').css('padding', '0px');
        $('button#read').css('margin', '0px');
    }

    // Recommencer l'histoire
    function startOver (show=true) {
        $('section div#storyContent').fadeOut('fast', function(){
            $('section div#storyContent').empty();
            insertStep(0);
            $('section div#storyContent').fadeIn('fast');
            hideStartBtn();
        });
    }

    function isLoggedIn(){
        if (userId != 0) {
            return true;
        } else {
            return false;
        }
    }

    $('.startOverDiv').click(function(){
        if (confirm('Etes-vous sûr de vouloir recommancer cette histoire depuis le début ?')) {
            startOver();
        }
    })

    // Liker l'histoire
    $('.likeStoryDiv').click(function(){
        if (isLiked == 1) {isLiked = 0}
        else {isLiked = 1;}
        if (isLoggedIn()) {
            $.ajax({
                type: "POST",
                url: "jquery/likeStory.php",   
                data: {
                    id_story:storyId,
                    id_user:userId,
                    value:isLiked
                },
                success: function(result) {
                    newSrc = isLiked?'images/liked.png':'images/like.png'
                    $('.likeStoryImg').attr('src', newSrc);
                }
            });
        } else {
            alert('Vous devez être connecté pour pouvoir aimer cette histoire !')
        }
    });

    // Sauver progression
    $('.saveProgressDiv').click(function(){
        if (isLoggedIn()) {
            var path = '';
            $('section div#storyContent div').children('article').each(function(){
                if ($(this).hasClass('clicked')) {
                    path += $(this).find('div input').val() + '/';
                }
            });
            $.ajax({
                type: "POST",
                url: "jquery/saveStory.php",   
                data: {
                    id_story:storyId,
                    id_user:userId,
                    path:path
                }
            });
        } else {
            alert('Vous devez être connecté pour pouvoir sauvegarder votre progrès !')
        }
    });
    // ***

    // Charger progression
    $('.loadProgressDiv').click(function(){
        if (isLoggedIn()) {
            if (confirm('Etes-vous sur de vouloir charger votre dernière progression ? Cela effacera votre avancée actuelle !')) {
                $.ajax({
                    type: "POST",
                    url: "jquery/loadProgress.php",   
                    data: {
                        id_story:storyId,
                        id_user:userId,
                    },
                    success: function(result){
                        data = JSON.parse(result);
                        if (data.length > 0 && data[0].path.length > 0) {
                            $('section div#storyContent').empty();
                            hideStartBtn();
                            var path = data[0].path;
                            var pathArray = path.split('/');
                            var contentArray = [];
                            for (var i=0; i<pathArray.length; i++) {
                                if (pathArray[i] != '') {
                                    var mainDiv = $('div#storyContent').append("<div id='"+pathArray[i]+"'><article class='card step'><div><p></p></div></article><article class='card choice noselect clicked'><div><input type='hidden' value='"+pathArray[i]+"'><p></p></div></article></div>");
                                    var div = mainDiv.find('div#' + pathArray[i])
                                    contentArray.push({'id':pathArray[i], 'div':div})
                                }
                            }
                            for (var content of contentArray) {
                                getText(content);
                            }
                            insertStep(contentArray[contentArray.length-1].id);
                        } else {
                            alert("Vous n'avez pas encore de sauvegarde pour cette histoire !");
                        }
                    }
                });
                $('section div#storyContent').show();
            }
        } else {
            alert('Vous devez être connecté pour pouvoir faire ça !')
        }
    });

    function getText(content){
        $.ajax({
            type: "POST",
            url: "jquery/get_text.php",
            data: {
                id_choice:content.id,
            },
            success: function(result){
                // console.log(result)
                data = JSON.parse(result);
                content.step = data[1][0].content;
                content.choice = data[0][0].content;
                insertText(content);
            }
        });
    }

    function insertText(content){
        $($(content.div).find('article.choice')).css('cursor', 'auto');
        var choiceP = $(content.div).find('article.choice p')
        var stepP = $(content.div).find('article.step p ')
        $(choiceP).text(content.choice);
        $(stepP).text(content.step);
    }
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