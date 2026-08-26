(function() {
  if( window.tinymce!=undefined ) {
    const tinyMCEInit = window.tinymce;
    tinyMCEInit.PluginManager.add( 'ctabutton', function( editor, url ) {
      //console.log(url);
      var parts = url.split('assets');
      var themeURL = parts[0];
      
      // Add Button to Visual Editor Toolbar
      editor.addButton('edbutton1', {
          title: 'Button',
          cmd: 'edbutton1',
          image: themeURL + 'assets/img/custom-button.png',
      });

      // Add Command when Button Clicked
      editor.addCommand('edbutton1', function() {
        var selected_text = editor.selection.getContent();
        if ( selected_text.length === 0 ) {
            alert( 'Please select some text.' );
            return;
        }
        var open_column = '<a data-mce-href="#" href="#"  data-mce-selected="inline-boundary" class="button-element button">';
        var close_column = '</a>';
        var return_text = '';
        return_text = open_column + selected_text + close_column;
        editor.execCommand('mceReplaceContent', false, return_text);
        return;
      });
    });

  }
})();