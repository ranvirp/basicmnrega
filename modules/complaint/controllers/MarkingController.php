<?php

namespace app\modules\complaint\controllers;

use app\modules\mnrega\models\Marking;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\ComplaintReply;
use yii\web\NotFoundHttpException;
use app\modules\users\models\Designation;
use yii\helpers\Url;
use Yii;

class MarkingController extends \yii\web\Controller {
    public function actionClosemarking($markingid)
    {
      $marking=Marking::findOne($markingid);
      if ($marking->sender==Designation::getDesignationByUser(Yii::$app->user->id))
        {$marking->flag=1;$marking->save();print 'done';}
        else
         print 'not allowed';
    }
	public function actionIndex($markingid) {
		$complaintview = '';
		$actionbuttons = '<ul class="nav nav-pills">';
		
		$marking = $this->findMarking($markingid);
		$complaintview.='<a class="hide" id="maincontainerrefreshlink" href="'.Url::to(['/complaint/marking/?markingid='.$markingid]).'"></a>';

		$complaintview.='<div class="col-md-12">Marking Id #' . $marking->id . ' marked to ' . $marking->receiver_name . '</div>';
		if (Yii::$app->user->can('complaintadmin')) {
			$complaint = Complaint::findOne($marking->request_id);

			$complaintview.= $this->renderPartial('@app/modules/complaint/views/complaint/view', ['model' => $complaint]);

			$replytype = 'Review';
			if (($complaint->status == Complaint::ATR_RECEIVED) || ($complaint->status == Complaint::ENQUIRY_REPORT_RECEIVED))
				$actionbuttons.='<li>'.$this->renderPartial('actionreview', ['text' => $replytype, 'id' => $marking->request_id, 'marking' => $marking]).'</li>';
			if ($markingid != $complaint->enqrofficer)
				$actionbuttons.=$this->renderPartial('actionmarkthis', ['text' => "Mark this marking for Enquiry", 'id' => $marking->request_id, 'markingid' => $marking->id, 'a' => 'e']);
			else
				$actionbuttons.='<p>' . 'Assigned for Enquiry' . '</p>';
			if ($markingid != $complaint->atrofficer)
				$actionbuttons.=$this->renderPartial('actionmarkthis', ['text' => "Mark this marking for ATR", 'id' => $marking->request_id, 'markingid' => $marking->id, 'a' => 'a']);
			else
				$actionbuttons.='<p>' . 'Assigned for ATR' . '</p>';
		}
		else
		if ($this->_ismarkedtocurrentuser($marking->request_id, $markingid)) {
			$complaint = Complaint::findOne($marking->request_id);

			$complaintview.= $this->renderPartial('@app/modules/complaint/views/complaint/view', ['model' => $complaint]);

			if ($marking->status == Complaint::PENDING_FOR_ENQUIRY) {
				$replytype = 'File Enquiry Report';
				$actionbuttons.='<li>'.$this->renderPartial('actionreply', ['text' => $replytype . ' for myself', 'id' => $marking->request_id, 'markingid' => $marking->id]).'</li>';
			} else if ($marking->status == Complaint::PENDING_FOR_ATR) {
				$replytype = 'File ATR';
				
				$actionbuttons.=$this->renderPartial('actionreply', ['text' => $replytype . ' for myself', 'id' => $marking->request_id, 'markingid' => $marking->id]);
			}
			$submarkings = Marking::find()->where(['sender' => Designation::getDesignationByUser(Yii::$app->user->id), 'request_type' => 'complaint', 'request_id' => $marking->request_id])->andWhere('flag=0')->all();
            if (!$submarkings && ($marking->status==Complaint::PENDING_FOR_ATR) && (Yii::$app->user->can('canmark')))
              $actionbuttons.='<li>'. $this->renderPartial('actionmarkofficer', ['text' => Yii::t("app", "Mark an Officer for Enquiry"), 'id' => $marking->request_id, 'a' => 'e', 'change' => 1]) . '</li>';
		    
			foreach ($submarkings as $submarking) {
			if ($submarking->status==Complaint::ENQUIRY_REPORT_RECEIVED)
			continue;
			  $actionbuttons.='<u>'.'Marked to '.$submarking->receiver_name.' for enquiry'.'</u>';
				if ($submarking->status == Complaint::PENDING_FOR_ENQUIRY) {
					$replytype = 'File Enquiry Report';
					$actionbuttons.='<li>'.$this->renderPartial('actionreply', ['text' => $replytype . ' for ' . $submarking->receiver_name, 'id' => $marking->request_id, 'markingid' => $marking->id]).'</li>';
					$actionbuttons.='<li>'.$this->renderPartial('actionclosemarking', ['text' => 'Close this marking for'.$submarking->receiver_name, 'id' => $marking->request_id, 'markingid' => $submarking->id]).'</li>';
				} else if ($submarking->status == Complaint::PENDING_FOR_ATR) {
					$replytype = 'File ATR';
					$actionbuttons.='<li>'.$this->renderPartial('actionreply', ['text' => $replytype . ' for ' . $submarking->receiver_name, 'id' => $marking->request_id, 'markingid' => $marking->id]).'</li>';
				}
				else 
				 {
				    $actionbuttons.='<span class="pull-right">' . $this->renderPartial('actionmarkofficer', ['text' => Yii::t("app", "Mark an Officer for Enquiry"), 'id' => $marking->request_id, 'a' => 'e', 'change' => 1]) . '</span>';
		     
				 }
				$reports = ComplaintReply::find()->where(['marking_id' => $submarking->id])->andWhere(['reply_type' => ComplaintReply::ENQUIRY_REPORT])->orWhere(['reply_type' => ComplaintReply::ATR_REPORT])->andWhere(['accepted' => 0])->all();
				foreach ($reports as $report) {
					$actionbuttons.='<li>'.'Report Received from '.$submarking->receiver_name.'</li>';
				}
			}
		}
		$actionbuttons.='</ul>';
		return $this->renderAjax('controlpanel', ['complaintview' => $complaintview, 'actionbuttons' => $actionbuttons,'id'=>0,'markingid'=>$markingid]);
	}

	public function actionComplaint($id, $markingid = 0) {


		$complaintview = '';
		$actionbuttons = '<ul class="nav nav-pills nav-stacked">';
		$complaint = Complaint::findOne($id);
		$this->_removeInconsistencies($complaint);
		$complaintview.='<a class="hide" id="maincontainerrefreshlink" href="'.Url::to(['/complaint/marking/complaint?id='.$id.'&markingid='.$markingid]).'"></a>';

		$complaintview.= $this->renderPartial('@app/modules/complaint/views/complaint/view', ['model' => $complaint]);
		$statusNames=Complaint::statusNames();
		$actionbuttons .= '<div id="complaint-status-div">' . $statusNames[$complaint->status] . '</div>';
		// $complaintview.='<div class="col-md-12">Complaint Id #'.$complaint->id.' marked to '.$complaint->receiver1?$complaint->receiver1->name_hi.'</div>';
		if (Yii::$app->user->can('complaintadmin')) {
			$actionbuttons.='<p class="bg-success"><strong>' . Yii::t('app', 'Enquiry Officer') . '</strong></p>';
			$enqrofficermarking = $complaint->enquiryOfficer;
			$enqrofficername = $enqrofficermarking ? $enqrofficermarking->receiver_name : '';
			$actionbuttons.='<p>' . $enqrofficername;
			if ($enqrofficermarking != null)
				$actionbuttons.='<span class="pull-right">' . $this->renderPartial('actionmarkofficer', ['text' => Yii::t("app", "Change"), 'id' => $id, 'a' => 'e', 'change' => 1]) . '</span>';
			else
				$actionbuttons.='<span>' . Yii::t('app', 'Nobody') . '</span>' . '<span class="pull-right">' . $this->renderPartial('actionmarkofficer', ['text' => Yii::t("app", "Appoint"), 'id' => $id, 'a' => 'e','change'=>0]) . '</span>';
			$actionbuttons.='<p class="bg-success"><strong>' . Yii::t('app', 'ATR Officer') . '</strong></p>';
			$atrofficermarking = $complaint->atrOfficer;
			$atrofficername = $atrofficermarking ? $atrofficermarking->receiver_name : '';
			$actionbuttons.='<p>' . $atrofficername;
			if ($atrofficermarking != null)
				$actionbuttons.='<span class="pull-right">' . $this->renderPartial('actionmarkofficer', ['text' => Yii::t("app", "Change"), 'id' => $id, 'a' => 'a', 'change' => 1]) . '</span>';
			else
				$actionbuttons.='<span>' . Yii::t('app', 'Nobody') . '</span>' . '<span class="pull-right">' . $this->renderPartial('actionmarkofficer', ['text' => Yii::t("app", "Appoint"), 'id' => $id, 'a' => 'a', 'change' => 0]) . '</span>';

			$actionbuttons.='</p>';
			$replytype = 'Review';


			if ($complaint->status == Complaint::ATR_RECEIVED) {
				$actionbuttons.='<li class="active">'.$this->renderPartial('actionstatus', ['text' => "Mark as Disposed", 'id' => $id, 'status' => Complaint::DISPOSED]).'</li>';
				$actionbuttons .= '<li class="active">'.$this->renderPartial('actionmarkthis', ['text' => "Ask for fresh report with comment", 'id' => $id,'markingid'=>$complaint->atrofficer, 'a' => 'a']).'</li>';
			} else if ($complaint->status == Complaint::ENQUIRY_REPORT_RECEIVED) {
				$atrmarking = $complaint->atrofficer;
				$actionbuttons.='<li>'.$this->renderPartial('actionstatus', ['text' => "Mark as Pending for ATR", 'id' => $id, 'status' => Complaint::PENDING_FOR_ATR]) . '</li>';
				$actionbuttons .= '<li>'.$this->renderPartial('actionmarkthis', ['text' => "Ask for fresh report with comment", 'id' => $id, 'markingid'=>$complaint->enqrofficer, 'a' => 'e']).'</li>';
			}
			if ($complaint->status == Complaint::PENDING_FOR_ENQUIRY && is_numeric($complaint->enqrofficer)) {
			if ($enqrofficermarking)
			  {
				$replytype = 'File Enquiry Report';
				$actionbuttons.=$this->renderPartial('actionreply', ['text' => $replytype . ' for '.$enqrofficername, 'id' => $id, 'markingid' => $complaint->enqrofficer]);
			  }
			} else if ($complaint->status == Complaint::PENDING_FOR_ATR && is_numeric($complaint->atrofficer)) {
				$replytype = 'File ATR';
				$actionbuttons.='<li>'.$this->renderPartial('actionreply', ['text' => $replytype . ' for '.$atrofficername, 'id' => $id, 'markingid' => $complaint->atrofficer]).'</li>';
			}
		}
        $actionbuttons.='</ul>';
		return $this->renderAjax('controlpanel', ['complaintview' => $complaintview, 'actionbuttons' => $actionbuttons,'id'=>$id,'markingid'=>0]);
	}

	protected function _ismarkedtocurrentuser($id, $markingid) {
		if ($markingid == 0)
			return false;
		$marking1 = Marking::find()->where(['id' => $markingid, 'request_id' => $id, 'receiver' => Designation::getDesignationByUser(Yii::$app->user->id)])->one();
		$marking2 = Marking::find()->where(['id' => $markingid, 'request_id' => $id, 'sender' => Designation::getDesignationByUser(Yii::$app->user->id)])->one();
		return $marking1 or $marking2;
	}

	protected function findMarking($markingid) {
		if (($model = Marking::findOne(['id' => $markingid])) != null) {
			if ($model->request_type == 'complaint')
				return $model;
			else
				throw new \yii\web\NotFoundHttpException("Not found");
		} else
			throw new \yii\web\NotFoundHttpException("Not found");
	}

	public function actionMarkthis($id, $markingid, $a = 'e',$c=0) {
		if (!Yii::$app->user->can('complaintadmin'))
			return "Not Allowed";
		$transaction = Yii::$app->db->beginTransaction();
		$model = new ComplaintReply();
		$model->complaint_id = $id;
		$model->marking_id = $markingid;
		$model->reply_type=ComplaintReply::INSTRUCTION;
		$model->created_at=time();
		$model->updated_at=time();
		$model->author=Yii::$app->user->id;
		$marking=Marking::findOne($markingid);
		if ($model->load(Yii::$app->request->post())) {
            
			if (!$model->save())
			{
				print_r($model->errors);
		
			}
			
		$complaint = Complaint::findOne($id);
		if ($a == 'e')
		{
			if ($c==0)
			{
			  $complaint->enqrofficer = $markingid;
			  $marking->status=Complaint::PENDING_FOR_ENQUIRY;
			  $complaint->status=Complaint::PENDING_FOR_ENQUIRY;
			}
			else
			{
				unset($complaint->enqrofficer);
			}
		}
		else if ($a == 'a')
			if ($c==0)
			{
			$complaint->atrofficer = $markingid;
			$marking->status=Complaint::PENDING_FOR_ATR;
			$complaint->status=Complaint::PENDING_FOR_ATR;
			}
			else
			{
				unset($complaint->enqrofficer);
			}
			
		$complaint->save();
		$marking->save();
		$transaction->commit();
		return "done";
		$model = new ComplaintReply;
		} else
		{
		//$searchModel = new ComplaintReplySearch();
		//$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			return $this->renderAjax('markthis', [
					// 'searchModel' => $searchModel,
					//'dataProvider' => $dataProvider,
					'model' => $model,
				    'id'=>$id,
				    'markingid'=>$markingid,
				    'a'=>$a,
			]);
			}

	}

	protected function _removeInconsistencies($complaint) {
	        if ($complaint->status==Complaint::ENQUIRY_REPORT_RECEIVED)
	        {
	          if ($complaint->enqrofficer == null)
	          {
	            $complaint->status=COMPLAINT::PENDING_FOR_ATR;
	            $complaint->save();
	          }
	        }
	        if ($complaint->status==Complaint::ATR_RECEIVED)
	        {
	          if ($complaint->atrofficer == null)
	          {
	            $complaint->status=COMPLAINT::PENDING_FOR_ATR;
	            $complaint->save();
	          }
	        }
		//All markings which is more advanced than current status of complaint shall be deactivated
		$markings = Marking::find()->where('status>' . $complaint->status)->all();
		foreach ($markings as $marking) {
			if ((($marking->id === $complaint->enqrofficer) && ($complaint->status==Complaint::PENDING_FOR_ENQUIRY) )|| (($marking->id === $complaint->atrofficer) && ($complaint->status==Complaint::PENDING_FOR_ATR))) {
				$marking->status = $complaint->status;
				$marking->flag = 0;
			} else {
				$marking->flag = 1;
			}//deactivate marking
			$marking->save();
		}
	}

}