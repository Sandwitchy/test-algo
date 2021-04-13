SELECT
    a.name,
    r.id,
    r.author,
    r.grade,
    r.comment,
    r.review_date
FROM
   (
       SELECT ROW_NUMBER()
       OVER(PARTITION BY artisan_id
            ORDER BY review_date DESC) AS StRanks, `id`,`artisan_id`,`author`,`grade`,`comment`,`review_date`
       FROM user_review
) r 
LEFT JOIN artisan a ON r.artisan_id = a.id
WHERE
    StRanks <= 3