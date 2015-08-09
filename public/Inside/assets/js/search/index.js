/*
	Inspired by Dribble "Search..."
    By: Anish Chandran
    Link: http://drbl.in/nRxe
*/

var searchField = $('.search');
var searchInput = $("input[type='search']");

var checkSearch = function(){
    var contents = searchInput.val();
    if(contents.length !== 0){
       searchField.addClass('full');
    } else {
       searchField.removeClass('full');
    }
};

$("input[type='search']").focus(function(){
    searchField.addClass('isActive');
  }).blur(function(){
  	searchField.removeClass('isActive');
    checkSearch();
});