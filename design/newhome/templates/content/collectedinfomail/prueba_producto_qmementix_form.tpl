{set-block scope=root variable=subject}Formulario de Prueba de Qmementix{/set-block}
{set-block scope=root variable=email_sender}contacto@efl.es{/set-block}
{append-block scope=root variable=receiver}mjizquierdo@efl.es{/append-block}
{append-block scope=root variable=email_cc_receivers}mourelle@efl.es{/append-block}
{append-block scope=root variable=email_cc_receivers}iglesias@efl.es{/append-block}
{append-block scope=root variable=email_cc_receivers}hurtado@efl.es{/append-block}
{append-block scope=root variable=email_cc_receivers}bsimon@efl.es{/append-block}
{append-block scope=root variable=email_cc_receivers}dentici@efl.es{/append-block}
CAMPOS DEL FORMULARIO:


{$collection.attributes[0].contentclass_attribute_name|wash()} {attribute_result_gui view=info attribute=$collection.attributes[0]}:{attribute_result_gui view=info attribute=$collection.attributes[1]}
Nombre: {attribute_result_gui view=info attribute=$collection.attributes[2]}
Apelidos: {attribute_result_gui view=info attribute=$collection.attributes[3]}
Email: {attribute_result_gui view=info attribute=$collection.attributes[4]}
Teléfono: {attribute_result_gui view=info attribute=$collection.attributes[5]}
Acepto la Política de Privacidad: {attribute_result_gui view=info attribute=$collection.attributes[6]}
Colectivo del que procede el usuario: {attribute_result_gui view=info attribute=$collection.attributes[7]}
