update up_block set mnregablock_code=t.block_code,mnregadistrict_code=t.district_code from (select b_code,block_code,b_name,block_name,district_name,dist_name,block.district_code
from (up_block inner join block on lower(up_block.b_name)=lower(block.block_name))
inner join district on district.district_code=block.district_code) as t
where up_block.b_code=t.b_code;
