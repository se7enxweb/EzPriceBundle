<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$site.http_equiv.Content-language|wash}" lang="{$site.http_equiv.Content-language|wash}">
<head>
{def $estamos_en_home=false()}{if eq($module_result.node_id,2)}{set $estamos_en_home=true()}{/if}
{def $estamos_en_sage=false()}{if eq($module_result.uri|extract_left(17),'/recursospsm_sage')}{set $estamos_en_sage=true()}{/if}
{def $user_hash         = concat( $current_user.role_id_list|implode( ',' ), ',', $current_user.limited_assignment_value_list|implode( ',' ) )}


{if is_set( $extra_cache_key )|not}
    {def $extra_cache_key = ''}
{/if}

{if and( ezhttp_hasvariable( 'hash', 'get'), ezhttp_hasvariable( 'id', 'get') )}
    {concat( 'newsletter/track/', ezhttp( 'hash', 'get' ), '/', ezhttp( 'id', 'get' ) )|redirect}
{/if}

{cache-block keys=array( $module_result.uri, fetch( 'shop', 'basket' ).items|count, $current_user.contentobject_id, $extra_cache_key )}
{def $pagedata         = ezpagedata()
     $pagestyle        = $pagedata.css_classes
     $locales          = fetch( 'content', 'translation_list' )
     $pagedesign       = $pagedata.template_look
     $current_node_id  = $pagedata.node_id}

{include uri='design:page_head.tpl'}
{include uri='design:page_head_style.tpl'}
{include uri='design:page_head_script.tpl'}

</head>


<body {if or( $module_result.node_id|eq(2), $module_result.node_id|eq(1058) )}id="home"{/if}>
    <div id="wrapper">
  {if and( is_set( $pagedata.persistent_variable.extra_template_list ), 
             $pagedata.persistent_variable.extra_template_list|count() )}
    {foreach $pagedata.persistent_variable.extra_template_list as $extra_template}
      {include uri=concat('design:extra/', $extra_template)}
    {/foreach}
  {/if}

  
  {include uri='design:page_header.tpl' }
  
  


  
  {if $pagedata.top_menu}
    {include uri='design:page_topmenu.tpl'}
  {/if}
  

  {*
  {if $pagedata.show_path}
    {include uri='design:page_toppath.tpl'}
  {/if}
  *}
  
 
  {if and( $pagedata.website_toolbar, $pagedata.is_edit|not)}
    {include uri='design:page_toolbar.tpl'}
  {/if} 
  {* Si no estamos en la home *}
			{if $estamos_en_home|not}
				{include uri="design:breadCrumb.tpl}
			{/if}

{/cache-block}
  <!-- Main area: START -->
  
	{if ezhttp_hasvariable( 'cd_camp', 'get' )}
		{def $cd_camp_get = ezhttp( 'cd_camp', 'get' )}
		{session_set( 'cd_camp_sesion', $cd_camp_get ) }
	{/if}

    {if ezhttp_hasvariable( 'gclid', 'get' )}
        {def $gclid = ezhttp( 'gclid', 'get' )}
        {session_set( 'gclid_sesion', $gclid ) }
	{/if}


  {include uri='design:page_mainarea.tpl'}
  {cache-block keys=array( $module_result.uri, $user_hash, $access_type.name, $extra_cache_key )}  
  
  {include uri='design:page_footer.tpl'}  

</div>

{include uri='design:page_footer_script.tpl'}

<script type="text/javascript">
{literal}
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2627590-1']);
  _gaq.push(['_setDomainName', '.efl.es']);
  _gaq.push(['_setAllowHash', false]);
  _gaq.push(['_trackPageview']); 

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
{/literal}
</script>
{/cache-block}


{* This comment will be replaced with actual debug report (if debug is on). *}
<!--DEBUG_REPORT-->

</body>
</html>