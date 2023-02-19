DECLARE @a integer;
DECLARE @day varchar;

SET @a = 0;
SET @day = 'DAY'

SELECT N, P, K, time from lora_npk_t WHERE time = (
 select DAYOFWEEK(FROM_UNIXTIME(time as a)) //expect return = 1-7

if (a > 0) then
	if (a = 1) then
        SELECT N, P, K, time FROM lora_npk_t WHERE time = 
)