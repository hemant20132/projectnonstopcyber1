
(function ($) {
 "use strict";
			
	
$('#jstree1').jstree({
            'core' : {
                'check_callback' : true
            },
            'plugins' : [ 'types', 'dnd' ],
            'types' : {
                'default' : {
                    'icon' : 'fa fa-folder'
                },
                'html' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'svg' : {
                    'icon' : 'fa fa-file-picture-o'
                },
                'css' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'img' : {
                    'icon' : 'fa fa-file-image-o'
                },
                'js' : {
                    'icon' : 'fa fa-file-text-o'
                }

            }
        });

        $('#using_json').jstree({
            'core' : {
            'data' : [
                'Empty Folder',
                {
                    'text': 'Resources',
                    'state': {
                        'opened': true
                    },
                    'children': [
                        {
                            'text': 'css',
                            'children': [
                                {
                                    'text': 'animate.css', 'icon': 'none'
                                },
                                {
                                    'text': 'bootstrap.css', 'icon': 'none'
                                },
                                {
                                    'text': 'main.css', 'icon': 'none'
                                },
                                {
                                    'text': 'style.css', 'icon': 'none'
                                }
                            ],
                            'state': {
                                'opened': true
                            }
                        },
                        {
                            'text': 'js',
                            'children': [
                                {
                                    'text': 'bootstrap.js', 'icon': 'none'
                                },
                                {
                                    'text': 'inspinia.min.js', 'icon': 'none'
                                },
                                {
                                    'text': 'jquery.min.js', 'icon': 'none'
                                },
                                {
                                    'text': 'jsTree.min.js', 'icon': 'none'
                                },
                                {
                                    'text': 'custom.min.js', 'icon': 'none'
                                }
                            ],
                            'state': {
                                'opened': true
                            }
                        },
                        {
                            'text': 'html',
                            'children': [
                                {
                                    'text': 'layout.php', 'icon': 'none'
                                },
                                {
                                    'text': 'navigation.php', 'icon': 'none'
                                },
                                {
                                    'text': 'navbar.php', 'icon': 'none'
                                },
                                {
                                    'text': 'footer.php', 'icon': 'none'
                                },
                                {
                                    'text': 'sidebar.php', 'icon': 'none'
                                }
                            ],
                            'state': {
                                'opened': true
                            }
                        }
                    ]
                },
                'Fonts',
                'Images',
                'Scripts',
                'Templates',
            ]
        } });
	
	
})(jQuery); 

