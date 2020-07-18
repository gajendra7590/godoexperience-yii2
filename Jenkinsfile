pipeline {

  agent { label 'master' }

  options {

    disableConcurrentBuilds()
    timeout(time: 10, unit: 'MINUTES')
    buildDiscarder(logRotator(numToKeepStr: '10'))

  } // options

  parameters {

    string(name: 'SLACK_CHANNEL_2',
           description: 'Default Slack channel to send messages to',
           defaultValue: '#godoexperience')           

  } // parameters

  environment {

    // Slack configuration
    SLACK_COLOR_DANGER  = '#E01563'
    SLACK_COLOR_INFO    = '#6ECADC'
    SLACK_COLOR_WARNING = '#FFC300'
    SLACK_COLOR_GOOD    = '#3EB991'

  } // environment

  stages {
//Development 
    stage("Deliver for Developemnt") { 
        when {
                branch 'master'
            }
      steps {
        script {
          //enable remote triggers
          properties([pipelineTriggers([pollSCM('* * * * *')])])
                 sh 'rsync -zarvh . ubuntu@52.33.120.31:/var/www/html/godoexperience-php/ --exclude .git '
                 sh 'ssh ubuntu@52.33.120.31 " cd /var/www/html/godoexperience-php/admin/ && sudo chmod 777 assets/ && sudo chmod 777 runtime/ && sudo chmod 777 web/assets "'
                 sh 'ssh ubuntu@52.33.120.31 " cd /var/www/html/godoexperience-php/ && sudo chmod 777 uploads/ && sudo chmod 777 uploads/* && sudo composer update "'
                 sh 'ssh ubuntu@52.33.120.31 " cd /var/www/html/godoexperience-php/ && sudo chmod 777 frontend/assets/ && sudo chmod 777 frontend/runtime/ && sudo chmod 777 frontend/web/assets/ "'
                 sh 'ssh ubuntu@52.33.120.31 "cp /home/ubuntu/credentials/godoexperience/main-local.php  /var/www/html/godoexperience-php/common/config/ "'
         } // script
      } // steps
    } // stage
 //Staging     
       
//Production
    stage("Deliver for master") { 
        when {
                branch 'xxx'
            }
      steps {
        script {
          //enable remote triggers
          properties([pipelineTriggers([pollSCM('* * * * *')])])
         } // script
      } // steps
    } // stage
 //Staging     
       
} // stages

  post {

    aborted {

      echo "Sending message to Slack"
      slackSend (color: "${env.SLACK_COLOR_WARNING}",
                 channel: "${params.SLACK_CHANNEL_2}",
                 message: "*ABORTED:* Job ${env.JOB_NAME} build ${env.BUILD_NUMBER} by ${env.USER_ID}")
    } // aborted

    failure {

      echo "Sending message to Slack"
      slackSend (color: "${env.SLACK_COLOR_DANGER}",
                 channel: "${params.SLACK_CHANNEL_2}",
                 message: "*FAILED:* Job ${env.JOB_NAME} build ${env.BUILD_NUMBER} by ${env.USER_ID}")
    } // failure

    success {
      echo "Sending message to Slack"
      slackSend (color: "${env.SLACK_COLOR_GOOD}",
                 channel: "${params.SLACK_CHANNEL_2}",
                 message: "*SUCCESS:* Job ${env.JOB_NAME} build ${env.BUILD_NUMBER} by ${env.USER_ID}")
    } // success

  } // post
} // pipeline


