/* jce - 2.6.19 | 2017-08-10 | http://www.joomlacontenteditor.net | Copyright (C) 2006 - 2017 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function(){var cookie=tinymce.util.Cookie;tinymce.create("tinymce.plugins.VisualBlocks",{init:function(ed,url){function toggleVisualBlocks(){var linkElm,dom=ed.dom;cssId?(linkElm=dom.get(cssId),linkElm.disabled=!linkElm.disabled):(cssId=dom.uniqueId(),linkElm=dom.create("link",{id:cssId,rel:"stylesheet",href:url+"/css/visualblocks.css"}),ed.getDoc().getElementsByTagName("head")[0].appendChild(linkElm)),ed.controlManager.setActive("visualblocks",!linkElm.disabled),linkElm.disabled?cookie.set("wf_visualblocks_state",0):cookie.set("wf_visualblocks_state",1)}var cssId;if(window.NodeList){var state=cookie.get("wf_visualblocks_state");state&&tinymce.is(state,"string")&&("null"==state&&(state=0),state=parseFloat(state)),state=ed.getParam("visualblocks_default_state",state),ed.addCommand("mceVisualBlocks",function(){toggleVisualBlocks()}),ed.onSetContent.add(function(){var linkElm,dom=ed.dom;cssId&&(linkElm=dom.get(cssId),ed.controlManager.setActive("visualblocks",!linkElm.disabled))}),ed.addButton("visualblocks",{title:"visualblocks.desc",cmd:"mceVisualBlocks"}),ed.onInit.add(function(){state&&toggleVisualBlocks()})}}}),tinymce.PluginManager.add("visualblocks",tinymce.plugins.VisualBlocks)}();