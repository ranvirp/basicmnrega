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
		$actionbuttons = '';
		
		$marking = $this->findMarking($markingid);
		$complaintview.='<a class="hide" id="maincontainerrefreshlink" href="'.Url::to(['/complaint/marking/?markingid='.$markingid]).'"></a>';

		$complaintview.='<div class="col-md-12">Marking Id #' . $marking->id . ' marked to ' . $marking->receiver_name . '</div>';
		if (Yii::$app->user->can('complaintadmin')) {
			$complaint = Complaint::findOne($marking->request_id);

			$complaintview.= $this->renderPartial('@app/modules/complaint/views/complaint/view', ['model' => $complaint]);

			$replytype = 'Review';
			if (($complaint->status == Complaint::ATR_RECEIVED) || ($complaint->status == Complaint::ENQUIRY_REPORT_RECEIVED))
				$actionbuttons.=$this->renderPartial('actionreview', ['text' => $replytype, 'id' => $marking->request_id, 'marking' => $marking]);
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
				$actionbuttons.=$this->renderPartial('actionreply', ['text' => $replytype . ' for myself', 'id' => $marking->request_id, 'markingid' => $marking->id]);
			} else if ($marking->status == Complaint::PENDING_FOR_ATR) {
				$replytype = 'File ATR';
				
				$actionbuttons.=$this->renderPartial('actionreply', ['text' => $replytype . ' for myself', 'id' => $marking->request_id, 'markingid' => $marking->id]);
			}
			$submarkings = Marking::find()->where(['sender' => Designation::getDesignationByUser(Yii::$app->user->id), 'request_type' => 'complaint', 'request_id' => $marking->request_id])->andWhere('flag=0')->all();
            if (!$submarkings && ($marking->status==Complaint::PENDING_FOR_ATR))
              $actionbuttons.='<span>' . $this->renderPartial('actionmarkofficer', ['text' => Yii::t("app", "Mark an Officer for Enquiry"), 'id' => $marking->request_id, 'a' => 'e', 'change' => 1]) . '</span>';
		    
			foreach ($submarkings as $submarking) {
			  $actionbuttons.='<u>'.'Marked to '.$submarking->receiver_name.' for enquiry'.'</u>';
				if ($submarking->status == Complaint::PENDING_FOR_ENQUIRY) {
					$replytype = 'File Enquiry Report';
					$actionbuttons.=$this->renderPartial('actionreply', ['text' => $replytype . ' for ' . $submarking->receiver_name, 'id' => $marking->request_id, 'markingid' => $marking->id]);
					$actionbuttons.=$this->renderPartial('actionclosemarking', ['text' => 'Close this marking for'.$submarking->receiver_name, 'id' => $marking->request_id, 'markingid' => $submarking->id]);
				} else if ($submarking->status == Complaint::PENDING_FOR_ATR) {
					$replytype = 'File ATR';
					$actionbuttons.=$this->renderPartial('actionreply', ['text' => $replytype . ' for ' . $submarking->receiver_name, 'id' => $marking->request_id, 'markingid' => $marking->id]);
				}
				else 
				 {
				    $actionbuttons.='<span class="pull-right">' . $this->renderPartial('actionmarkofficer', ['text' => Yii::t("app", "Mark an Officer for Enquiry"), 'id' => $marking->request_id, 'a' => 'e', 'change' => 1]) . '</span>';
		     
				 }
				$reports = ComplaintReply::find()->where(['marking_id' => $submarking->id])->andWhere(['reply_type' => ComplaintReply::ENQUIRY_REPORT])->orWhere(['reply_type' => ComplaintReply::ATR_REPORT])->andWhere(['accepted' => 0])->all();
				foreach ($reports as $report) {
					$actionbuttons.='<p>'.'Report Received from '.$submarking->receiver_name.'</p>';
				}
			}
		}
		return $this->renderAjax('controlpanel', ['complaintview' => $complaintview, 'actionbuttons' => $actionbuttons,'id'=>0,'markingid'=>$markingid]);
	}

	public function actionComplaint($id, $markingid = 0) {


		$complaintview = '';
		$actionbuttons = '';
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
				$actionbuttons.='<span>' . Yii::t('app', 'Nobody') . '</span>' . '<span class="pull-right">' . $this->renderPartial('actionmarkofficer', ['text' => Yii::t("app", "Appoint"), 'id' => $id, 'a' => 'e']) . '</span>';
			$actionbuttons.='<p class="bg-success"><strong>' . Yii::t('app', 'ATR Officer') . '</strong></p>';
			$atrofficermarking = $complaint->atrOfficer;
			$atrofficername = $atrofficermarking ? $atrofficermarking->receiver_name : '';
			$actionbuttons.='<p>' . $atrofficername;
			if ($atrofficermarking != null)
				$actionbuttons.='<span class="pull-right">' . $this->renderPartial('actionmarkofficer', ['text' => Yii::t("app", "Change"), 'id' => $id, 'a' => 'a', 'change' => 1]) . '</span>';
			else
				$actionbuttons.='<span>' . Yii::t('app', 'Nobody') . '</span>' . '<span class="pull-right">' . $this->renderPartial('actionmarkofficer', ['text' => Yii::t("app", "Appoint"), 'id' => $id, 'a' => 'a', 'change' => 1]) . '</span>';

			$actionbuttons.='</p>';
			$replytype = 'Review';


			if ($complaint->status == Complaint::ATR_RECEIVED) {
				$actionbuttons.=$this->renderPartial('actionstatus', ['text' => "Mark as Disposed", 'id' => $id, 'status' => Complaint::DISPOSED]);
				$actionbuttons .= $this->renderPartial('actionmarkthis', ['text' => "Ask for fresh report with comment", 'id' => $id,'markingid'=>$complaint->atrofficer, 'a' => 'a']);
			} else if ($complaint->status == Complaint::ENQUIRY_REPORT_RECEIVED) {
				$atrmarking = $complaint->atrofficer;
				$actionbuttons.='<p>' . $this->renderPartial('actionstatus', ['text' => "Mark as Pending for ATR", 'id' => $id, 'status' => Complaint::PENDING_FOR_ATR]) . '</p>';
				$actionbuttons .= $this->renderPartial('actionmarkthis', ['text' => "Ask for fresh report with comment", 'id' => $id, 'markingid'=>$complaint->enqrofficer, 'a' => 'e']);
			}
			if ($complaint->status == Complaint::PENDING_FOR_ENQUIRY) {
			if ($enqrofficermarking)
			  {
				$replytype = 'File Enquiry Report';
				$actionbuttons.=$this->renderPartial('actionreply', ['text' => $replytype . ' for '.$enqrofficername, 'id' => $id, 'markingid' => $complaint->enqrofficer]);
			  }
			} else if ($complaint->status == Complaint::PENDING_FOR_ATR) {
				$replytype = 'File ATR';
				$actionbuttons.=$this->renderPartial('actionreply', ['text' => $replytype . ' for '.$atrofficername, 'id' => $id, 'markingid' => $complaint->atrofficer]);
			}
		}

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
		} else
		// $searchModel = new ComplaintReplySearch();
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

	protected function _removeInconsistencies($complaint) {
		//All markings which is more advanced than current status of complaint shall be deactivated
		$markings = Marking::find()->where('status>' . $complaint->status)->all();
		foreach ($markings as $marking) {
			if (($marking->id === $complaint->enqrofficer) || ($marking->id === $complaint->atrofficer)) {
				$marking->status = $complaint->status;
				$marking->flag = 0;
			} else {
				$marking->flag = 1;
			}//deactivate marking
			$marking->save();
		}
	}

}
