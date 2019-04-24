"use strict";

(function () {
    
    var table_width_fixer = function () { //to fix position of table head elements and table body elements avoiding offset width of scrollbar in table_body
        var table_header_width = document.getElementsByClassName("table_header")[0].offsetWidth;
        var table_body_width = document.getElementsByClassName("table_body")[0].offsetWidth;
        var scrollbar_width_fixer = document.getElementsByClassName("scrollbar_width_fixer")[0];
        return scrollbar_width_fixer.style.width = table_header_width - table_body_width + "px";
    }
    
    if (document.getElementsByClassName("table_header")[0]) { // to check if table exists
        table_width_fixer();
    }
    
}) ();