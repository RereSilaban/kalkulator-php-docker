pipeline {
    agent any

    environment {
        // Variabel biar nggak ngetik ulang path panjang-panjang
        JMETER_BIN = 'C:\\Users\\APLIC\\Documents\\apache-jmeter-5.6.3\\apache-jmeter-5.6.3\\bin\\jmeter.bat'
        JMX_SCRIPT = 'D:\\Devops-PT\\Script\\Kalkulator.jmx'
        RESULT_FILE = 'D:\\Devops-PT\\Result\\hasil_akhir.jtl'
    }

    stages {
        stage('Checkout') {
            steps {
                echo 'Mengambil kode dari Workspace...'
                // Opsional: Kamu bisa tambahkan git checkout di sini nanti
            }
        }

        stage('Build Docker Image') {
            steps {
                echo 'Building Docker Image: kalkulator-php-test...'
                bat 'docker build -t kalkulator-php-test .'
            }
        }

        stage('Deploy Container') {
            steps {
                echo 'Cleaning up old container and deploying new one...'
                // Stop & Remove container lama jika ada (exit 0 supaya gak error kalau container gak ada)
                bat 'docker stop kalkulator-running || exit 0'
                bat 'docker rm kalkulator-running || exit 0'
                bat 'docker run -d --name kalkulator-running -p 9090:80 kalkulator-php-test'
            }
        }

        stage('Performance Test') {
            steps {
                echo 'Starting Load Test with JMeter...'
                // -n (non-gui), -t (script), -l (log result), -f (force overwrite)
                bat "${JMETER_BIN} -n -t \"${JMX_SCRIPT}\" -l \"${RESULT_FILE}\" -f"
                
                echo '--- MENAMPILKAN HASIL TEST ---'
                bat "type \"${RESULT_FILE}\""
            }
        }
    }

    post {
        always {
            echo 'Proses Selesai!'
            mail to: 'reisnaulilammaida@gmail.com',
                 subject: "Build ${env.JOB_NAME} #${env.BUILD_NUMBER} - Status: ${currentBuild.currentResult}",
                 body: """
                 Halo Re,
                 
                 Build: ${env.JOB_NAME}
                 Number: ${env.BUILD_NUMBER}
                 Status: ${currentBuild.currentResult}
                 
                 Cek detailnya di sini: ${env.BUILD_URL}
                 """
        }
        
        failure {
            echo 'Build Gagal! Mengirim email notifikasi...'
            // Notifikasi spesifik kalau gagal
        }
    }
}