{literal}
<script language="JavaScript" type="text/javascript">
<!--
document.write("<style type='text/css'>div#contentstructure ul#content_tree_menu ul li { padding-left: 0px; }div#contentstructure ul#content_tree_menu ul ul { margin-left: 20px; }<\/style>");
-->
</script>
{/literal}

{* tree menu mit newsletter inhalten *}
<script language="JavaScript" type="text/javascript" src={"javascript/lib/ezjslibie50support.js"|ezdesign}></script>
<script language="JavaScript" type="text/javascript" src={"javascript/lib/ezjslibcookiesupport.js"|ezdesign}></script>
<script language="JavaScript" type="text/javascript" src={"javascript/lib/ezjslibdomsupport.js"|ezdesign}></script>
<script language="JavaScript" type="text/javascript" src={"javascript/lib/ezjslibimagepreloader.js"|ezdesign}></script>
<script language="JavaScript" type="text/javascript" src={"javascript/contentstructuremenu/contentstructuremenu.js"|ezdesign}></script>

{let rootNodeID             = 1
     classFilter            = ezini( 'TreeMenu', 'ShowClasses'      , 'contentstructuremenu.ini' )
     maxDepth               = ezini( 'TreeMenu', 'MaxDepth'         , 'contentstructuremenu.ini' )
     maxNodes               = ezini( 'TreeMenu', 'MaxNodes'         , 'contentstructuremenu.ini' )
     sortBy                 = ezini( 'TreeMenu', 'SortBy'           , 'contentstructuremenu.ini' )
     fetchHidden            = ezini( 'SiteAccessSettings', 'ShowHiddenNodes', 'site.ini'         )
     itemClickAction        = ezini( 'TreeMenu', 'ItemClickAction'  , 'contentstructuremenu.ini' )
     classIconsSize         = ezini( 'TreeMenu', 'ClassIconsSize'   , 'contentstructuremenu.ini' )
     preloadClassIcons      = ezini( 'TreeMenu', 'PreloadClassIcons', 'contentstructuremenu.ini' )
     autoopenCurrentNode    = ezini( 'TreeMenu', 'AutoopenCurrentNode', 'contentstructuremenu.ini' )
     contentStructureTree   = false()
     menuID                 = "content_tree_menu"
     isDepthUnlimited       = eq($:maxDepth, 0)
     rootNode               = false }

    {* check size of icons *}
    {section show=is_set($:class_icons_size)}
        {set classIconsSize=$:class_icons_size}
    {/section}

    {* load icons if preloadClassIcons is enabled *}
    {section show=eq( $:preloadClassIcons, "enabled" )}
        {let iconInfo           = icon_info( class )
             iconsThemePath     = $:iconInfo.theme_path
             iconsList          = $:iconInfo.icons
             defaultIcon        = $:iconInfo.default
             iconSizePath       = $:iconInfo.size_path_list[$:classIconsSize] }

            <script language="JavaScript" type="text/javascript"><!--

                var iconsList       = new Array();
                var wwwDirPrefix    = "{ezsys('wwwdir')}";
                var iconPath        = "";

                // oridinary icons.
                {section var=icon loop=$:iconsList}
                    iconPath = wwwDirPrefix + "/" + "{$:iconsThemePath}" + "/" + "{$:iconSizePath}" + "/" + "{$:icon}";
                    iconsList.push( iconPath );
                {/section}

                // default icon.
                iconPath = wwwDirPrefix + "/" + "{$:iconsThemePath}" + "/" + "{$:iconSizePath}" + "/" + "{$:defaultIcon}";
                iconsList.push( iconPath );

                // load them all!!
                ezjslib_preloadImageList( iconsList );

            // -->
            </script>
        {/let}
    {/section}

    {* check custom_root_node *}
    {section show=is_set( $custom_root_node_id )}
        {set rootNodeID=$custom_root_node_id}
    {/section}

    {set rootNode=fetch( 'content', 'node', hash( node_id, $:rootNodeID ) )}

    {* check custom action when clicking on menu item *}
    {section show=and( is_set( $csm_menu_item_click_action ), eq( $itemClickAction, '' ) )}
        {set itemClickAction=$csm_menu_item_click_action}
    {/section}

    {* if menu action is set translate it to url *}
    {section show=eq( $itemClickAction, '' )|not()}
        {set itemClickAction = $:itemClickAction|ezurl(no)}
    {/section}

    {* create menu *}
        {*set contentStructureTree = content_structure_tree( $:rootNodeID,
                                                            $:classFilter,
                                                            $:maxDepth,
                                                            $:maxNodes,
                                                            $:sortBy,
                                                            $:fetchHidden ) *}
        {* Show menu tree. All container nodes are unfolded. *}
            {*<h4>Alle Systeme</h4>*}
            <ul id="{$:menuID}">
                {include uri="design:contentstructuremenu/2_newsletter_system_tree.tpl" contentStructureTree=$contentStructureTree class_icons_size=$:classIconsSize csm_menu_item_click_action=$:itemClickAction ui_context=$ui_context is_root_node=true()}
            </ul>

    {* initialize menu *}
    <script language="JavaScript" type="text/javascript"><!--

        {* get path to current node which consists of nodes ids *}
        var nodesList = new Array();

        {section var=path loop=$module_result.path}
            {section show=and(is_set($:path.node_id), or($:isDepthUnlimited, $:maxDepth|gt(0)))}
                nodesList.push( "n{$:path.node_id}" );
                {set maxDepth = dec($:maxDepth)}
            {/section}
        {/section}


        ezcst_setFoldUnfoldIcons( {"images/content_tree-open.gif"|ezdesign}, {"images/content_tree-close.gif"|ezdesign}, {"images/1x1.gif"|ezdesign} );
        ezcst_initializeMenuState( nodesList, "{$:menuID}", "{$:autoopenCurrentNode}" );
    // -->
    </script>
{/let}
