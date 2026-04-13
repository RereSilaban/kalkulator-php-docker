pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                echo 'Mengambil kode dari folder...'
            }
        }
        stage('Build Docker Image') {
            steps {
                bat 'docker build -t kalkulator-php-test .'
            }
        }
        stage('Deploy Container') {
            steps {
                bat 'docker stop kalkulator-running || exit 0'
                bat 'docker rm kalkulator-running || exit 0'
                bat 'docker run -d --name kalkulator-running -p 9090:80 kalkulator-php-test'
            }
        }
        stage('Performance Test') {
            steps {
                echo 'Menjalankan Load Test...'
                bat 'C:\\Users\\APLIC\\Documents\\apache-jmeter-5.6.3\\apache-jmeter-5.6.3\\bin\\jmeter.bat -n -t "D:\\Devops-PT\\Script\\Kalkulator.jmx" -l "D:\\Devops-PT\\Result\\hasil_akhir.jtl" -f'
                
                // Trik: Mencari kata ",false,". Kalau KETEMU, jalankan exit 1 (Bikin Jenkins Merah)
                bat 'findstr /C:",false," "D:\\Devops-PT\\Result\\hasil_akhir.jtl" && (echo WADUH ADA ERROR! && exit 1) || (echo SEMUA REQUEST AMAN!)'
                
                echo '--- MEMBACA HASIL DARI DRIVE D ---'
                bat 'type "D:\\Devops-PT\\Result\\hasil_akhir.jtl"'
            }
        }
    } // <--- KURUNG INI PENTING! Ini penutup STAGES.

    post {
        always {
            echo 'Proses Selesai!'
            mail to: 'reisnaulilammaida@gmail.com',
                 subject: "Yuhu! Build ${env.JOB_NAME} Updated nih!",
                 body: "Ada Update dan buld baru ya. Link: ${env.BUILD_URL}"
        }
        failure {
            echo 'Build Gagal! Mengirim email...'
            mail to: 'reisnaulilammaida@gmail.com',
                 subject: "Waduh! Build ${env.JOB_NAME} Gagal nih!",
                 body: "Cek buruan di Jenkins ya, ada yang error pas build Docker-nya. Link: ${env.BUILD_URL}"
        }
    }
}