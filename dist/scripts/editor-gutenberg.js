"use strict";wp.domReady(function(){wp.blocks.unregisterBlockStyle("core/button","outline"),wp.blocks.unregisterBlockStyle("core/button","squared"),wp.blocks.unregisterBlockStyle("core/image","circle-mask"),wp.blocks.unregisterBlockStyle("core/quote","large"),wp.blocks.unregisterBlockStyle("core/separator","dots"),wp.blocks.unregisterBlockStyle("core/separator","wide")}),wp.hooks.addFilter("blocks.registerBlockType","aucor-starter/filters",function(e,r){var s;switch(r){case"core/file":case"core/freeform":case"core/heading":case"core/list":case"core/paragraph":case"core/quote":case"core/separator":s=!1;break;case"core/button":s=["center"];break;case"core/gallery":case"core/table":s=["wide"];break;case"core/group":case"core/media-text":s=["wide","full"];break;case"core/image":s=["left","center","right","wide"];break;default:return e}return lodash.assign({},e,{supports:lodash.assign({},e.supports,{align:s})})}),wp.hooks.addFilter("blocks.registerBlockType","aucor-starter/filters",function(e,r){return lodash.assign({},e,{supports:lodash.assign({},e.supports,{className:!0})})});
//# sourceMappingURL=editor-gutenberg.js.map