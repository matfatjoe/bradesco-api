<?php

namespace Matfatjoe\BradescoBoleto\Models;

/**
 * Modelo de Boleto do Bradesco baseado na estrutura real da API
 */
class BoletoBradesco
{
    private $ctitloCobrCdent;
    private $registrarTitulo;
    private $nroCpfCnpjBenef;
    private $codUsuario;
    private $filCpfCnpjBenef;
    private $tipoAcesso;
    private $digCpfCnpjBenef;
    private $cpssoaJuridContr;
    private $ctpoContrNegoc;
    private $cidtfdProdCobr;
    private $nseqContrNegoc;
    private $cnegocCobr;
    private $filler;
    private $eNseqContrNegoc;
    private $tipoRegistro;
    private $codigoBanco;
    private $cprodtServcOper;
    private $demisTitloCobr;
    private $ctitloCliCdent;
    private $dvctoTitloCobr;
    private $cidtfdTpoVcto;
    private $vnmnalTitloCobr;
    private $cindcdEconmMoeda;
    private $cespceTitloCobr;
    private $qmoedaNegocTitlo;
    private $ctpoProteTitlo;
    private $cindcdAceitSacdo;
    private $ctpoPrzProte;
    private $ctpoPrzDecurs;
    private $ctpoProteDecurs;
    private $cctrlPartcTitlo;
    private $cindcdPgtoParcial;
    private $cformaEmisPplta;
    private $qtdePgtoParcial;
    private $qtdDecurPrz;
    private $codNegativacao;
    private $diasNegativacao;
    private $ptxJuroVcto;
    private $filler1;
    private $vdiaJuroMora;
    private $pmultaAplicVcto;
    private $qdiaInicJuro;
    private $vmultaAtrsoPgto;
    private $pdescBonifPgto01;
    private $qdiaInicMulta;
    private $vdescBonifPgto01;
    private $pdescBonifPgto02;
    private $dlimDescBonif1;
    private $vdescBonifPgto02;
    private $pdescBonifPgto03;
    private $dlimDescBonif2;
    private $vdescBonifPgto03;
    private $ctpoPrzCobr;
    private $dlimDescBonif3;
    private $pdescBonifPgto;
    private $dlimBonifPgto;
    private $vdescBonifPgto;
    private $vabtmtTitloCobr;
    private $filler2;
    private $viofPgtoTitlo;
    private $isacdoTitloCobr;
    private $enroLogdrSacdo;
    private $elogdrSacdoTitlo;
    private $ecomplLogdrSacdo;
    private $ccepSacdoTitlo;
    private $ebairoLogdrSacdo;
    private $ccomplCepSacdo;
    private $imunSacdoTitlo;
    private $indCpfCnpjSacdo;
    private $csglUfSacdo;
    private $renderEletrSacdo;
    private $cdddFoneSacdo;
    private $nroCpfCnpjSacdo;
    private $bancoDeb;
    private $cfoneSacdoTitlo;
    private $agenciaDebDv;
    private $agenciaDeb;
    private $bancoCentProt;
    private $contaDeb;
    private $isacdrAvalsTitlo;
    private $agenciaDvCentPr;
    private $enroLogdrSacdr;
    private $elogdrSacdrAvals;
    private $ecomplLogdrSacdr;
    private $ccomplCepSacdr;
    private $ebairoLogdrSacdr;
    private $csglUfSacdr;
    private $ccepSacdrTitlo;
    private $imunSacdrAvals;
    private $indCpfCnpjSacdr;
    private $renderEletrSacdr;
    private $nroCpfCnpjSacdr;
    private $cdddFoneSacdr;
    private $filler3;
    private $cfoneSacdrTitlo;
    private $iconcPgtoSpi;
    private $fase;
    private $cindcdCobrMisto;
    private $ialiasAdsaoCta;
    private $ilinkGeracQrcd;
    private $caliasAdsaoCta;
    private $wqrcdPdraoMercd;
    private $validadeAposVencimento;
    private $filler4;
    private $idLoc;

    // Construtor simplificado - apenas campos principais
    public function __construct(array $data = [])
    {
        // Campos principais
        $this->ctitloCobrCdent = $data['ctitloCobrCdent'] ?? 0;
        $this->registrarTitulo = $data['registrarTitulo'] ?? 1;
        $this->nroCpfCnpjBenef = $data['nroCpfCnpjBenef'] ?? null;
        $this->codUsuario = $data['codUsuario'] ?? null;
        $this->filCpfCnpjBenef = $data['filCpfCnpjBenef'] ?? null;
        $this->tipoAcesso = $data['tipoAcesso'] ?? 2;
        $this->digCpfCnpjBenef = $data['digCpfCnpjBenef'] ?? null;
        $this->cidtfdProdCobr = $data['cidtfdProdCobr'] ?? 9;
        $this->cnegocCobr = $data['cnegocCobr'] ?? null;
        $this->tipoRegistro = $data['tipoRegistro'] ?? 1;
        $this->codigoBanco = $data['codigoBanco'] ?? 237;
        $this->demisTitloCobr = $data['demisTitloCobr'] ?? null;
        $this->ctitloCliCdent = $data['ctitloCliCdent'] ?? null;
        $this->dvctoTitloCobr = $data['dvctoTitloCobr'] ?? null;
        $this->vnmnalTitloCobr = $data['vnmnalTitloCobr'] ?? null;
        $this->cindcdEconmMoeda = $data['cindcdEconmMoeda'] ?? 9;
        $this->cespceTitloCobr = $data['cespceTitloCobr'] ?? 2;
        $this->cindcdAceitSacdo = $data['cindcdAceitSacdo'] ?? 'N';
        $this->cindcdPgtoParcial = $data['cindcdPgtoParcial'] ?? 'N';
        $this->cformaEmisPplta = $data['cformaEmisPplta'] ?? '02';
        $this->fase = $data['fase'] ?? '1';
        $this->cindcdCobrMisto = $data['cindcdCobrMisto'] ?? 'S';

        // Dados do sacado
        $this->isacdoTitloCobr = $data['isacdoTitloCobr'] ?? null;
        $this->enroLogdrSacdo = $data['enroLogdrSacdo'] ?? null;
        $this->elogdrSacdoTitlo = $data['elogdrSacdoTitlo'] ?? null;
        $this->ecomplLogdrSacdo = $data['ecomplLogdrSacdo'] ?? null;
        $this->ccepSacdoTitlo = $data['ccepSacdoTitlo'] ?? null;
        $this->ebairoLogdrSacdo = $data['ebairoLogdrSacdo'] ?? null;
        $this->ccomplCepSacdo = $data['ccomplCepSacdo'] ?? null;
        $this->imunSacdoTitlo = $data['imunSacdoTitlo'] ?? null;
        $this->indCpfCnpjSacdo = $data['indCpfCnpjSacdo'] ?? null;
        $this->csglUfSacdo = $data['csglUfSacdo'] ?? null;
        $this->nroCpfCnpjSacdo = $data['nroCpfCnpjSacdo'] ?? null;

        // Outros campos opcionais
        $this->cpssoaJuridContr = $data['cpssoaJuridContr'] ?? '';
        $this->ctpoContrNegoc = $data['ctpoContrNegoc'] ?? '';
        $this->nseqContrNegoc = $data['nseqContrNegoc'] ?? '';
        $this->filler = $data['filler'] ?? '';
        $this->eNseqContrNegoc = $data['eNseqContrNegoc'] ?? '';
        $this->cprodtServcOper = $data['cprodtServcOper'] ?? '';
        $this->cidtfdTpoVcto = $data['cidtfdTpoVcto'] ?? '';
        $this->qmoedaNegocTitlo = $data['qmoedaNegocTitlo'] ?? 0;
        $this->ctpoProteTitlo = $data['ctpoProteTitlo'] ?? 0;
        $this->ctpoPrzProte = $data['ctpoPrzProte'] ?? 0;
        $this->ctpoPrzDecurs = $data['ctpoPrzDecurs'] ?? 0;
        $this->ctpoProteDecurs = $data['ctpoProteDecurs'] ?? 0;
        $this->cctrlPartcTitlo = $data['cctrlPartcTitlo'] ?? 0;
        $this->qtdePgtoParcial = $data['qtdePgtoParcial'] ?? 0;
        $this->qtdDecurPrz = $data['qtdDecurPrz'] ?? '0';
        $this->codNegativacao = $data['codNegativacao'] ?? '0';
        $this->diasNegativacao = $data['diasNegativacao'] ?? '0';
        $this->ptxJuroVcto = $data['ptxJuroVcto'] ?? 0;
        $this->filler1 = $data['filler1'] ?? '';
        $this->vdiaJuroMora = $data['vdiaJuroMora'] ?? 0;
        $this->pmultaAplicVcto = $data['pmultaAplicVcto'] ?? 0;
        $this->qdiaInicJuro = $data['qdiaInicJuro'] ?? 0;
        $this->vmultaAtrsoPgto = $data['vmultaAtrsoPgto'] ?? 0;
        $this->pdescBonifPgto01 = $data['pdescBonifPgto01'] ?? 0;
        $this->qdiaInicMulta = $data['qdiaInicMulta'] ?? 0;
        $this->vdescBonifPgto01 = $data['vdescBonifPgto01'] ?? 0;
        $this->pdescBonifPgto02 = $data['pdescBonifPgto02'] ?? 0;
        $this->dlimDescBonif1 = $data['dlimDescBonif1'] ?? '';
        $this->vdescBonifPgto02 = $data['vdescBonifPgto02'] ?? 0;
        $this->pdescBonifPgto03 = $data['pdescBonifPgto03'] ?? 0;
        $this->dlimDescBonif2 = $data['dlimDescBonif2'] ?? '';
        $this->vdescBonifPgto03 = $data['vdescBonifPgto03'] ?? 0;
        $this->ctpoPrzCobr = $data['ctpoPrzCobr'] ?? 0;
        $this->dlimDescBonif3 = $data['dlimDescBonif3'] ?? '';
        $this->pdescBonifPgto = $data['pdescBonifPgto'] ?? 0;
        $this->dlimBonifPgto = $data['dlimBonifPgto'] ?? '';
        $this->vdescBonifPgto = $data['vdescBonifPgto'] ?? 0;
        $this->vabtmtTitloCobr = $data['vabtmtTitloCobr'] ?? 0;
        $this->filler2 = $data['filler2'] ?? '';
        $this->viofPgtoTitlo = $data['viofPgtoTitlo'] ?? 0;
        $this->renderEletrSacdo = $data['renderEletrSacdo'] ?? '';
        $this->cdddFoneSacdo = $data['cdddFoneSacdo'] ?? 0;
        $this->bancoDeb = $data['bancoDeb'] ?? 0;
        $this->cfoneSacdoTitlo = $data['cfoneSacdoTitlo'] ?? 0;
        $this->agenciaDebDv = $data['agenciaDebDv'] ?? 0;
        $this->agenciaDeb = $data['agenciaDeb'] ?? 0;
        $this->bancoCentProt = $data['bancoCentProt'] ?? 0;
        $this->contaDeb = $data['contaDeb'] ?? 0;
        $this->isacdrAvalsTitlo = $data['isacdrAvalsTitlo'] ?? '';
        $this->agenciaDvCentPr = $data['agenciaDvCentPr'] ?? 0;
        $this->enroLogdrSacdr = $data['enroLogdrSacdr'] ?? '0';
        $this->elogdrSacdrAvals = $data['elogdrSacdrAvals'] ?? '';
        $this->ecomplLogdrSacdr = $data['ecomplLogdrSacdr'] ?? '';
        $this->ccomplCepSacdr = $data['ccomplCepSacdr'] ?? 0;
        $this->ebairoLogdrSacdr = $data['ebairoLogdrSacdr'] ?? '';
        $this->csglUfSacdr = $data['csglUfSacdr'] ?? '';
        $this->ccepSacdrTitlo = $data['ccepSacdrTitlo'] ?? 0;
        $this->imunSacdrAvals = $data['imunSacdrAvals'] ?? '';
        $this->indCpfCnpjSacdr = $data['indCpfCnpjSacdr'] ?? 0;
        $this->renderEletrSacdr = $data['renderEletrSacdr'] ?? '';
        $this->nroCpfCnpjSacdr = $data['nroCpfCnpjSacdr'] ?? 0;
        $this->cdddFoneSacdr = $data['cdddFoneSacdr'] ?? 0;
        $this->filler3 = $data['filler3'] ?? '0';
        $this->cfoneSacdrTitlo = $data['cfoneSacdrTitlo'] ?? 0;
        $this->iconcPgtoSpi = $data['iconcPgtoSpi'] ?? '';
        $this->ialiasAdsaoCta = $data['ialiasAdsaoCta'] ?? '';
        $this->ilinkGeracQrcd = $data['ilinkGeracQrcd'] ?? '';
        $this->caliasAdsaoCta = $data['caliasAdsaoCta'] ?? '';
        $this->wqrcdPdraoMercd = $data['wqrcdPdraoMercd'] ?? '';
        $this->validadeAposVencimento = $data['validadeAposVencimento'] ?? '';
        $this->filler4 = $data['filler4'] ?? '';
        $this->idLoc = $data['idLoc'] ?? '';
    }

    public function toArray(): array
    {
        return [
            'ctitloCobrCdent' => $this->ctitloCobrCdent,
            'registrarTitulo' => $this->registrarTitulo,
            'nroCpfCnpjBenef' => $this->nroCpfCnpjBenef,
            'codUsuario' => $this->codUsuario,
            'filCpfCnpjBenef' => $this->filCpfCnpjBenef,
            'tipoAcesso' => $this->tipoAcesso,
            'digCpfCnpjBenef' => $this->digCpfCnpjBenef,
            'cpssoaJuridContr' => $this->cpssoaJuridContr,
            'ctpoContrNegoc' => $this->ctpoContrNegoc,
            'cidtfdProdCobr' => $this->cidtfdProdCobr,
            'nseqContrNegoc' => $this->nseqContrNegoc,
            'cnegocCobr' => $this->cnegocCobr,
            'filler' => $this->filler,
            'eNseqContrNegoc' => $this->eNseqContrNegoc,
            'tipoRegistro' => $this->tipoRegistro,
            'codigoBanco' => $this->codigoBanco,
            'cprodtServcOper' => $this->cprodtServcOper,
            'demisTitloCobr' => $this->demisTitloCobr,
            'ctitloCliCdent' => $this->ctitloCliCdent,
            'dvctoTitloCobr' => $this->dvctoTitloCobr,
            'cidtfdTpoVcto' => $this->cidtfdTpoVcto,
            'vnmnalTitloCobr' => $this->vnmnalTitloCobr,
            'cindcdEconmMoeda' => $this->cindcdEconmMoeda,
            'cespceTitloCobr' => $this->cespceTitloCobr,
            'qmoedaNegocTitlo' => $this->qmoedaNegocTitlo,
            'ctpoProteTitlo' => $this->ctpoProteTitlo,
            'cindcdAceitSacdo' => $this->cindcdAceitSacdo,
            'ctpoPrzProte' => $this->ctpoPrzProte,
            'ctpoPrzDecurs' => $this->ctpoPrzDecurs,
            'ctpoProteDecurs' => $this->ctpoProteDecurs,
            'cctrlPartcTitlo' => $this->cctrlPartcTitlo,
            'cindcdPgtoParcial' => $this->cindcdPgtoParcial,
            'cformaEmisPplta' => $this->cformaEmisPplta,
            'qtdePgtoParcial' => $this->qtdePgtoParcial,
            'qtdDecurPrz' => $this->qtdDecurPrz,
            'codNegativacao' => $this->codNegativacao,
            'diasNegativacao' => $this->diasNegativacao,
            'ptxJuroVcto' => $this->ptxJuroVcto,
            'filler1' => $this->filler1,
            'vdiaJuroMora' => $this->vdiaJuroMora,
            'pmultaAplicVcto' => $this->pmultaAplicVcto,
            'qdiaInicJuro' => $this->qdiaInicJuro,
            'vmultaAtrsoPgto' => $this->vmultaAtrsoPgto,
            'pdescBonifPgto01' => $this->pdescBonifPgto01,
            'qdiaInicMulta' => $this->qdiaInicMulta,
            'vdescBonifPgto01' => $this->vdescBonifPgto01,
            'pdescBonifPgto02' => $this->pdescBonifPgto02,
            'dlimDescBonif1' => $this->dlimDescBonif1,
            'vdescBonifPgto02' => $this->vdescBonifPgto02,
            'pdescBonifPgto03' => $this->pdescBonifPgto03,
            'dlimDescBonif2' => $this->dlimDescBonif2,
            'vdescBonifPgto03' => $this->vdescBonifPgto03,
            'ctpoPrzCobr' => $this->ctpoPrzCobr,
            'dlimDescBonif3' => $this->dlimDescBonif3,
            'pdescBonifPgto' => $this->pdescBonifPgto,
            'dlimBonifPgto' => $this->dlimBonifPgto,
            'vdescBonifPgto' => $this->vdescBonifPgto,
            'vabtmtTitloCobr' => $this->vabtmtTitloCobr,
            'filler2' => $this->filler2,
            'viofPgtoTitlo' => $this->viofPgtoTitlo,
            'isacdoTitloCobr' => $this->isacdoTitloCobr,
            'enroLogdrSacdo' => $this->enroLogdrSacdo,
            'elogdrSacdoTitlo' => $this->elogdrSacdoTitlo,
            'ecomplLogdrSacdo' => $this->ecomplLogdrSacdo,
            'ccepSacdoTitlo' => $this->ccepSacdoTitlo,
            'ebairoLogdrSacdo' => $this->ebairoLogdrSacdo,
            'ccomplCepSacdo' => $this->ccomplCepSacdo,
            'imunSacdoTitlo' => $this->imunSacdoTitlo,
            'indCpfCnpjSacdo' => $this->indCpfCnpjSacdo,
            'csglUfSacdo' => $this->csglUfSacdo,
            'renderEletrSacdo' => $this->renderEletrSacdo,
            'cdddFoneSacdo' => $this->cdddFoneSacdo,
            'nroCpfCnpjSacdo' => $this->nroCpfCnpjSacdo,
            'bancoDeb' => $this->bancoDeb,
            'cfoneSacdoTitlo' => $this->cfoneSacdoTitlo,
            'agenciaDebDv' => $this->agenciaDebDv,
            'agenciaDeb' => $this->agenciaDeb,
            'bancoCentProt' => $this->bancoCentProt,
            'contaDeb' => $this->contaDeb,
            'isacdrAvalsTitlo' => $this->isacdrAvalsTitlo,
            'agenciaDvCentPr' => $this->agenciaDvCentPr,
            'enroLogdrSacdr' => $this->enroLogdrSacdr,
            'elogdrSacdrAvals' => $this->elogdrSacdrAvals,
            'ecomplLogdrSacdr' => $this->ecomplLogdrSacdr,
            'ccomplCepSacdr' => $this->ccomplCepSacdr,
            'ebairoLogdrSacdr' => $this->ebairoLogdrSacdr,
            'csglUfSacdr' => $this->csglUfSacdr,
            'ccepSacdrTitlo' => $this->ccepSacdrTitlo,
            'imunSacdrAvals' => $this->imunSacdrAvals,
            'indCpfCnpjSacdr' => $this->indCpfCnpjSacdr,
            'renderEletrSacdr' => $this->renderEletrSacdr,
            'nroCpfCnpjSacdr' => $this->nroCpfCnpjSacdr,
            'cdddFoneSacdr' => $this->cdddFoneSacdr,
            'filler3' => $this->filler3,
            'cfoneSacdrTitlo' => $this->cfoneSacdrTitlo,
            'iconcPgtoSpi' => $this->iconcPgtoSpi,
            'fase' => $this->fase,
            'cindcdCobrMisto' => $this->cindcdCobrMisto,
            'ialiasAdsaoCta' => $this->ialiasAdsaoCta,
            'ilinkGeracQrcd' => $this->ilinkGeracQrcd,
            'caliasAdsaoCta' => $this->caliasAdsaoCta,
            'wqrcdPdraoMercd' => $this->wqrcdPdraoMercd,
            'validadeAposVencimento' => $this->validadeAposVencimento,
            'filler4' => $this->filler4,
            'idLoc' => $this->idLoc
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}
