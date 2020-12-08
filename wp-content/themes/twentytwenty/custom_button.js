(function() {
	tinymce.PluginManager.add('custom_button', function( editor, url ) { 
		editor.addButton('custom_button', {  
			text: 'Подсказка',
            onclick: function() {
                let content = editor.selection.getContent();
               
                if(content == '') {
                    editor.windowManager.open( {
                        title: 'Ошибка',
                        body: [
                            {
                                type: 'container',
                                name   : 'container',
                                label  : 'Текст ошибки:',
                                html   : '<h1>Текст не выбран</h1>'
                            },
                         ],
                    });
                } else {
                    editor.windowManager.open( {
                        title: 'Параметры подсказки',
                        body: [
                            {
                                type: 'textbox',
                                name: 'tooltip_text', 
                                label: 'Введите текст подсказки:', 
                                value: '' 
                            },
                        ],
                        onsubmit: function(e) { 
                            editor.insertContent("[tooltip title="+ e.data.tooltip_text +"] "+ content + " [/tooltip]");
                        }
                    });
                }
            }
		});
	});
})();