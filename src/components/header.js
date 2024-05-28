import styles from './nav.module.css'
import {Link} from 'react-router-dom'


function Header(){
    return(
        <div>
       <header>
        <div className={styles.interface}>
            <div className={styles.texto}>
                <Link className={styles.link} to='/listar'>  <h1>Cidadão <span className={styles.app} >APP</span></h1></Link>
          
                
                
            </div> 

            
            <div className={styles.botao}>
                <Link to="/cadastrar">
                <button>Cadastro</button>
                </Link>
                
            </div>

        </div> 


    </header>  
      </div>
    )
}

export default Header;