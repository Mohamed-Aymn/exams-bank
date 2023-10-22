pipeline {
    agent any

    stages {
        stage('Checkout from GitHub') {
            steps {
                // Check out the code from your GitHub repository
                checkout([$class: 'GitSCM', branches: [[name: '*/main']], doGenerateSubmoduleConfigurations: false, extensions: []])
            }
        }

        stage('Install Composer Packages') {
            steps {
                sh 'composer install'
            }
        }

        stage('Deploy to EC2') {
            steps {
                script {
                    def remote = [:]

                    // exams_bank EC2 instance details
                    remote.name = 'ec2-instance'
                    remote.host = '172.31.33.102'
                    remote.user = 'ec2-user'
                    remote.identityFile = credentials('EXAMS_BANK_SSH')

                    // Connect to the EC2 instance using SSH
                    sshCommand(remote: remote, command: '''
                        cd /app
                        git pull origin main  # Ensure that code is up-to-date
                    ''')
                }
            }
        }
    }

    post {
        success {
            echo 'Deployment successful'
        }
        failure {
            echo 'Deployment failed'
        }
    }
}
