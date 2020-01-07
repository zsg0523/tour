<?php

/**
 * @Author: eden
 * @Date:   2020-01-07 11:41:50
 * @Last Modified by:   eden
 * @Last Modified time: 2020-01-07 12:04:31
 */
namespace App\Services;

use App\Models\Question;

/**
 * 
 */
class QuestionService
{
	
	/**
	 * [__construct 注入模型]
	 * @param Question $question [description]
	 */
	function __construct(Question $question)
	{
		$this->question = $question;
	}

	/**
	 * [getIds 获取ids]
	 * @return [type] [description]
	 */
	public function getAllIds()
	{
		return $this->question->all()->pluck('id')->toArray();	
	}

	/**
     * [getQuestion 查询模型]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getQuestionById($id)
    {
        return $this->question->find($id);
    }

    /**
     * [update 更新模型]
     * @param  [type] $id   [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function updateById($id, $data)
    {
    	return $this->question->where('id', $id)->update($data);
    }

    /**
     * [getTotal 求和]
     * @param  [type] $true_answer_numaber [答对次数]
     * @param  [type] $false_answer_number [答错次数]
     * @return [type]                      [description]
     */
    public function getTotal($true_answer_numaber, $false_answer_number)
    {
        return $true_answer_numaber + $false_answer_number;
    }






}