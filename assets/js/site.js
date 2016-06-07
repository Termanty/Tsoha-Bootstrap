$(document).ready(function(){
  $("#show_form").click(function(){
    $("#new_topic_form").removeClass('hidden');
    $("#show_form").addClass('hidden');
    $("#hide_form").removeClass('hidden');
  });
  $("#hide_form").click(function(){
    $("#new_topic_form").addClass('hidden');
    $("#show_form").removeClass('hidden');
    $("#hide_form").addClass('hidden');
  });    
});

