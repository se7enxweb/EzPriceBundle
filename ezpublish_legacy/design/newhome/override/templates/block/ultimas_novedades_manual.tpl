                        <div id="modNovedades">
                            <h3>Últimas novedades</h3>
                            <div class="carrousel">
                            	
                                <ul class="carrousel" id="itemscarrousel">
                                	{foreach $block.valid_nodes as $node}
                                    <li>
                                    	{def $area_node = fetch( 'content', 'object', hash( 'object_id', $node.data_map.area.content.relation_list.0.contentobject_id ) )}
                  
                <h4>{$area_node.name}</h4>
                                        
                                        {if $node.data_map.imagen.has_content}                                        
                                        {def $image = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ) )}
                                        <div class="multim">
                                       	<img src={$image.data_map.image.content.block_novedades.url|ezroot} alt="" class="producto" />
                                       	</div>
                                        {undef $image}
                                        {else}
                                        <div class="multim">
                                        {def $image = fetch( 'content', 'object', hash( 'object_id', 2084 ) )}
                                        <img src={$image.data_map.image.content.block_novedades.url|ezroot} alt="{$image.data_map.image.content.alternative_text}" class="producto" />
                                        {undef $image}
                                        </div>
                                        {/if}
                                        <a href={$node.url_alias|ezurl}><span>{$node.name}</span></a>
                                
  								{def $cuantasvaloracionestotales = fetch('producto','cuantasvaloraciones' , hash( 'node_id', $node.node_id ))}                                {if $cuantasvaloracionestotales|gt(0)}
                                         <span class="verMas">     <a href={concat($node.url_alias, '/(ver)/valoraciones')|ezroot()}>{$cuantasvaloracionestotales} {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuario</a></span>
								{/if}                        
                                {undef $cuantasvaloracionestotales}
                                      	
                                        <a href={concat( 'basket/ajaxadd/', $node.object.id, '/1')|ezurl} class="boton loQuiero"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                        
                                        
                                        <span class="verMas"><a style="background:none; padding-top:10px" href={concat("catalogo/area/", $area_node.name|normalize_path()|explode("_")|implode('-'))|ezurl}>Más obras del Área {$area_node.name}</a></span>
                                        {undef $area_node}
                                   </li>
                                   {/foreach}
                                </ul>
                            </div>
                            <a class="jcarousel-control-prev" href="#">anterior</a>
                            <a class="jcarousel-control-next" href="#">Next</a>
                        </div>