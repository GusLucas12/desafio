import styles from "./Home.module.css"
import guy from "../images/guy.png"
import { Link } from 'react-router-dom'
function Home() {
    return (
        <div className={styles.central}>
            <div className={styles.content}>
                <Link><img src={guy} alt=""></img></Link>
                <div className={styles.texto}>
                    <h1>Cidadão <span className={styles.app} >APP</span></h1>
                    <Link to='/'>
                        <button>Iniciar</button>
                    </Link>

                </div>

            </div>
        </div>
    );
}

export default Home;