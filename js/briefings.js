$(document).ready(function () {
    $('#btn_salvar_briefing').click(function(e) {
        e.preventDefault();
        $('<input>').attr({
            type: 'hidden',
            value: 'SAV',
            name: 'data[Briefing][status]'
        }).appendTo('#BriefingCreateForm');
        $('#BriefingCreateForm').submit();
    })
    $('#btn_enviar_briefing').click(function(e) {
        e.preventDefault();
        $('<input>').attr({
            type: 'hidden',
            value: 'ENV',
            name: 'data[Briefing][status]'
        }).appendTo('#BriefingCreateForm');
        $('#BriefingCreateForm').submit();
    })
});
