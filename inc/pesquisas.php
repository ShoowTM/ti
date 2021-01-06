<?php
//USUÁRIOS DO SISTEMA
$queryUsuarios = "SELECT 
MP.id_profile,
MP.profile_name,
MP.profile_mail,
MP.profile_type AS id_perfil,
MPT.type_name AS nome_perfil,
MP.profile_deleted,
MP.ativar_cpf,
MP.desativar_cpf,
MP.emitir_check_list,
MP.editar_historico,
MP.editar_cadastro_funcionario
FROM
manager_profile MP
LEFT JOIN
manager_profile_type MPT ON (MP.profile_type = MPT.type_profile)";

//COLABORADORES
$queryColaborador = "SELECT 
MIF.id_funcionario, 
MIF.nome, 
MIF.cpf,
MDF.nome AS funcao, 
MDD.nome AS departamento, 
MDE.nome AS empresa, 
MDS.nome AS status,
MIF.status AS id_status,
MIF.funcao AS id_funcao,
MIF.departamento AS id_departamento,
MIF.empresa AS id_empresa,
MIF.deletar
FROM
manager_inventario_funcionario MIF
LEFT JOIN
manager_dropfuncao MDF ON (MIF.funcao = MDF.id_funcao)
LEFT JOIN
manager_dropdepartamento MDD ON (MIF.departamento = MDD.id_depart)
LEFT JOIN
manager_dropempresa MDE ON (MIF.empresa = MDE.id_empresa)
LEFT JOIN
manager_dropstatus MDS ON (MIF.status = MDS.id_status)
LEFT JOIN
manager_inventario_equipamento MIE ON (MIF.id_funcionario = MIE.id_funcionario)";

//EQUIPAMENTOS
$queryEquipamento = "SELECT 
MIE.id_equipamento,
MIE.tipo_equipamento AS id_tipoEquipamento,
MIE.serialnumber,
MIE.hd,
MIE.processador,
MIE.memoria,
MDTE.nome AS tipo_equipamento,
MIE.modelo,
MIE.patrimonio,
MIE.filial AS id_filial,
MDL.nome AS empresa,
MIE.operadora AS id_operadora,
MDO.nome AS operadora,
MIE.numero,
MIE.imei_chip,
MIE.planos_voz,
MIE.planos_dados,
MIE.valor,
MIE.estado AS id_estado,
MDE.nome AS estado,
MIE.situacao AS id_situacao,
MDS.nome AS situacao,
MIE.status AS id_status,
MSE.nome AS status,
MIE.termo,
MIE.ip,
MIE.dominio
FROM
manager_inventario_equipamento MIE
LEFT JOIN
manager_dropempresa MDL ON (MIE.filial = MDL.id_empresa)
LEFT JOIN
manager_dropoperadora MDO ON (MIE.operadora = MDO.id_operadora)
LEFT JOIN
manager_dropestado MDE ON (MIE.estado = MDE.id)
LEFT JOIN
manager_dropsituacao MDS ON (MIE.situacao = MDS.id_situacao)
LEFT JOIN
manager_dropstatusequipamento MSE ON (MIE.status = MSE.id_status)
LEFT JOIN
manager_dropequipamentos MDTE ON (MIE.tipo_equipamento = MDTE.id_equip)";

//STATUS ATIVO COUNT
$queryAtivosFuncionario = "SELECT 
COUNT(id_funcionario) status 
FROM 
manager_inventario_funcionario 
WHERE 
status = 4 AND 
deletar = 0 
GROUP BY status";

//STATUS FALTA TERMO COUNT
$queryTermoFuncionario = "SELECT 
COUNT(id_funcionario) status 
FROM 
manager_inventario_funcionario 
WHERE 
status = 3 AND 
deletar = 0 
GROUP BY status";

//STATUS DEMITIDO COUNT
$queryDemitidoFuncionario = "SELECT 
COUNT(id_funcionario) status 
FROM 
manager_inventario_funcionario 
WHERE
status = 8 AND 
deletar = 0 
GROUP BY status";

//EQUIPAMENTOS COUNT
$queryEquipamentosCount = "SELECT 
COUNT(*) AS quantidade, 
id_funcionario 
FROM 
manager_inventario_equipamento";

//LOGS FUNCIONARIOS
$queryLog = "SELECT 
ML.id,
ML.id_funcionario, 
ML.data_alteracao, 
MIF.nome, 
MP.profile_name, 
ML.tipo_alteracao
FROM
manager_log ML
LEFT JOIN
manager_inventario_funcionario MIF ON (ML.id_funcionario = MIF.id_funcionario)
LEFT JOIN
manager_profile MP ON (ML.usuario = MP.id_profile)";

//SISTEMA OPERCIONAL
$queryso = "SELECT 
MSO.versao AS id_versao, 
MDSO.nome AS versao
FROM
manager_sistema_operacional MSO
LEFT JOIN
manager_dropsistemaoperacional MDSO ON (MSO.versao = MDSO.id)";

//OFFICE
$queryoffice = "SELECT 
MO.versao AS id_versao, 
MDO.nome AS versao
FROM
manager_office MO
LEFT JOIN
manager_dropoffice MDO ON (MO.versao = MDO.id)";