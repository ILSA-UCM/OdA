<script language="javascript" type="text/javascript" src="../../jscripts/tiny_mce/tiny_mce.js"></script>
			<script language="javascript" type="text/javascript">
			tinyMCE.init({
				mode : "textareas",
				theme : "simple",
				plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen",
				theme_advanced_buttons1_add_before : "save,newdocument,separator",
				//theme_advanced_buttons1_add : "fontselect,fontsizeselect",
				//theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor",
				theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
				theme_advanced_buttons3_add_before : "tablecontrols,separator",
				theme_advanced_buttons3_add : "iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_path_location : "bottom",
				content_css : "style.css",
				plugin_insertdate_dateFormat : "%Y-%m-%d",
				plugin_insertdate_timeFormat : "%H:%M:%S",
				extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
				external_link_list_url : "example_link_list.js",
				external_image_list_url : "example_image_list.js",
				flash_external_list_url : "example_flash_list.js",
				file_browser_callback : "fileBrowserCallBack"
			});

			function fileBrowserCallBack(field_name, url, type) {
				// This is where you insert your custom filebrowser logic
				alert("Filebrowser callback: " + field_name + "," + url + "," + type);
			}
		</script>